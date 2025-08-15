<?php

namespace App\Services;

use App\Models\Media;
use App\Jobs\UploadImageToCloudinaryJob;
use App\Services\MediaStorageService;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Exception;

class ImageUploadService
{
    protected MediaStorageService $storageService;

    public function __construct(MediaStorageService $storageService)
    {
        $this->storageService = $storageService;
    }
    /**
     * Upload image with async processing - save locally first, then upload to Cloudinary via job.
     *
     * @param UploadedFile $file
     * @param string $table
     * @return \App\Models\Media
     */
    public function uploadImage(UploadedFile $file, string $table): Media
    {
        try {
            // Save file to temporary storage using centralized service
            $storageResult = $this->storageService->saveToTempStorage($file);
            
            // Create media record with temporary local URL
            $media = $this->createMediaRecord(
                $storageResult['temp_url'],
                'temp_' . uniqid(), // Temporary public_id
                'image'
            );
            
            // Generate permanent proxy URL that will work with Quill
            $permanentUrl = route('media.serve', $media);
            
            // Update media record with permanent URL
            $media->update(['url' => $permanentUrl]);

            // Dispatch job to upload to Cloudinary asynchronously
            UploadImageToCloudinaryJob::dispatch($storageResult['local_path'], $media->id, $table);

            Log::info('Image saved locally and job dispatched', [
                'media_id' => $media->id,
                'local_path' => $storageResult['local_path'],
                'temp_url' => $storageResult['temp_url']
            ]);

            return $media;

        } catch (\Exception $e) {
            Log::error('Unexpected error during image upload', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'original_name' => $file->getClientOriginalName(),
                'size' => $file->getSize()
            ]);
            throw new Exception('Tải ảnh lên thất bại. Vui lòng thử lại.');
        }
    }

    /**
     * Upload file to Cloudinary from job.
     */
    public function uploadToCloudinaryFromJob(UploadedFile $file, string $table): array
    {
        return $this->uploadToCloudinary($file, $table);
    }

    /**
     * Upload file to Cloudinary.
     */
    private function uploadToCloudinary(UploadedFile $file, string $table): array
    {
        $folder = $this->getFolderFromTable($table);

        $uploadResult = Cloudinary::uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => $folder,
                'resource_type' => 'image',
                'quality' => 'auto:good',
                'fetch_format' => 'auto'
            ]
        );

        // Chuyển object -> array
        $resultArray = $uploadResult->getArrayCopy();

        // Ghi log để debug nếu cần
        Log::info('Cloudinary upload result array', ['result' => $resultArray]);

        // Kiểm tra kỹ để tránh lỗi thiếu field
        if (empty($resultArray['secure_url']) || empty($resultArray['public_id'])) {
            throw new \Exception('Upload failed - no URL returned');
        }

        return [
            'secure_url' => $resultArray['secure_url'],
            'public_id' => $resultArray['public_id']
        ];
    }


    /**
     * Create media record in database.
     */
    private function createMediaRecord(string $url, string $publicId, string $type): Media
    {   

        return Media::create([
            'url' => $url,
            'public_id' => $publicId,
            'type' => $type,
            'file_path' => $url // For backward compatibility
        ]);
    }

    /**
     * Delete image from Cloudinary and database.
     */
    public function deleteImage(string $publicId): bool
    {
        try {
            // Delete from Cloudinary
            Cloudinary::destroy($publicId);
            
            // Delete from database
            Media::where('public_id', $publicId)->delete();
            
            return true;
        } catch (\CloudinaryLabs\CloudinaryLaravel\CloudinaryException $e) {
            Log::error('Cloudinary deletion failed', [
                'error' => $e->getMessage(),
                'public_id' => $publicId
            ]);
            return false;
            
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error during media deletion', [
                'error' => $e->getMessage(),
                'public_id' => $publicId
            ]);
            return false;
            
        } catch (\Exception $e) {
            Log::error('Unexpected error during image deletion', [
                'error' => $e->getMessage(),
                'public_id' => $publicId
            ]);
            return false;
        }
    }

    /**
     * Get optimized image URL with transformations.
     */
    public function getOptimizedUrl(string $publicId, array $transformations = []): string
    {
        $defaultTransformations = [
            'quality' => 'auto:good',
            'fetch_format' => 'auto'
        ];

        $transformations = array_merge($defaultTransformations, $transformations);
        
        return Cloudinary::getUrl($publicId, $transformations);
    }

    private function getFolderFromTable(string $table): string
    {
        return match($table) {
            'articles' => 'articles/content',
            'portfolios' => 'portfolios/content',
            'partners' => 'partners/content',
            'services' => 'services/content',
            'company_settings' => 'company_settings/content',
            'custom_pages' => 'custom_pages/content',
            default => 'general/content'
        };
    }
}