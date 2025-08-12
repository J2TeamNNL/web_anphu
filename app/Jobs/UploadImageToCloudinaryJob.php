<?php

namespace App\Jobs;

use App\Models\Media;
use App\Services\ImageUploadService;
use App\Services\MediaStorageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UploadImageToCloudinaryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $localPath;
    protected int $mediaId;
    protected string $table;

    /**
     * Create a new job instance.
     */
    public function __construct(string $localPath, int $mediaId, string $table)
    {
        $this->localPath = $localPath;
        $this->mediaId = $mediaId;
        $this->table = $table;
    }

    /**
     * Execute the job.
     */
    public function handle(ImageUploadService $imageUploadService, MediaStorageService $storageService): void
    {
        // Get media record
        $media = Media::find($this->mediaId);
        if (!$media) {
            Log::error('Media record not found for async upload', ['media_id' => $this->mediaId]);
            $this->fail('Media record not found');
            return;
        }

        // Check if local file exists
        if (!$storageService->exists($this->localPath)) {
            Log::error('Local file not found for async upload', ['path' => $this->localPath]);
            $this->fail('Local file not found');
            return;
        }
        
        $fullPath = $storageService->getFullPath($this->localPath);

        // Create a temporary UploadedFile from the stored file
        $tempFile = new \Illuminate\Http\UploadedFile(
            $fullPath,
            basename($this->localPath),
            $storageService->getMimeType($this->localPath),
            null,
            true
        );

        // Upload to Cloudinary
        $uploadResult = $imageUploadService->uploadToCloudinaryFromJob($tempFile, $this->table);

        // Update media record with Cloudinary URL but keep the proxy URL structure
        // The proxy controller will redirect to Cloudinary automatically
        $media->update([
            'public_id' => $uploadResult['public_id'],
            'file_path' => $uploadResult['secure_url'] // Store Cloudinary URL for proxy to redirect
        ]);

        // Delete local file
        $storageService->delete($this->localPath);

        Log::info('Successfully uploaded image to Cloudinary and updated media record', [
            'media_id' => $this->mediaId,
            'cloudinary_url' => $uploadResult['secure_url']
        ]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('Failed to upload image to Cloudinary in job', [
            'media_id' => $this->mediaId,
            'local_path' => $this->localPath,
            'table' => $this->table,
            'error' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString()
        ]);

        // Clean up local file if it still exists
        $storageService = app(MediaStorageService::class);
        if ($storageService->exists($this->localPath)) {
            $storageService->delete($this->localPath);
            Log::info('Cleaned up local file after job failure', ['path' => $this->localPath]);
        }

        // Optionally mark media record as failed or revert to some default state
        $media = Media::find($this->mediaId);
        if ($media) {
            // You could add a 'status' field to track upload status
            // $media->update(['status' => 'failed']);
            Log::info('Media record exists but upload failed', ['media_id' => $this->mediaId]);
        }
    }
}
