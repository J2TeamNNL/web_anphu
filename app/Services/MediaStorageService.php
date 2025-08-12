<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MediaStorageService
{
    const TEMP_UPLOAD_DIR = 'temp_uploads';
    const PUBLIC_DISK = 'public';

    /**
     * Save uploaded file to temporary storage
     */
    public function saveToTempStorage(UploadedFile $file): array
    {
        $filename = $this->generateUniqueFilename($file);
        $localPath = self::TEMP_UPLOAD_DIR . '/' . $filename;
        
        // Save file to temporary storage
        $file->storeAs(self::TEMP_UPLOAD_DIR, $filename, self::PUBLIC_DISK);
        
        // Generate public URL
        $tempUrl = asset('storage/' . $localPath);
        
        return [
            'filename' => $filename,
            'local_path' => $localPath,
            'temp_url' => $tempUrl,
            'full_path' => Storage::disk(self::PUBLIC_DISK)->path($localPath)
        ];
    }

    /**
     * Check if file exists in storage
     */
    public function exists(string $path): bool
    {
        return Storage::disk(self::PUBLIC_DISK)->exists($path);
    }

    /**
     * Get file content from storage
     */
    public function getFileContent(string $path): string
    {
        return Storage::disk(self::PUBLIC_DISK)->get($path);
    }

    /**
     * Get full file path
     */
    public function getFullPath(string $path): string
    {
        return Storage::disk(self::PUBLIC_DISK)->path($path);
    }

    /**
     * Get MIME type of file
     */
    public function getMimeType(string $path): string
    {
        $fullPath = $this->getFullPath($path);
        return mime_content_type($fullPath);
    }

    /**
     * Delete file from storage
     */
    public function delete(string $path): bool
    {
        try {
            return Storage::disk(self::PUBLIC_DISK)->delete($path);
        } catch (\Exception $e) {
            Log::error('Failed to delete file from storage', [
                'path' => $path,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Extract local path from asset URL
     */
    public function extractLocalPathFromUrl(string $url): ?string
    {
        if (str_contains($url, 'storage/')) {
            return str_replace(asset('storage/'), '', $url);
        }
        return null;
    }

    /**
     * Check if URL is a local storage URL
     */
    public function isLocalStorageUrl(string $url): bool
    {
        return str_contains($url, 'storage/' . self::TEMP_UPLOAD_DIR . '/');
    }

    /**
     * Check if URL/path is a Cloudinary URL
     */
    public function isCloudinaryUrl(string $url): bool
    {
        return str_contains($url, 'cloudinary.com');
    }

    /**
     * Generate unique filename for uploaded file
     */
    private function generateUniqueFilename(UploadedFile $file): string
    {
        return time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    }

    /**
     * Clean up temporary files older than specified minutes
     */
    public function cleanupOldTempFiles(int $olderThanMinutes = 60): int
    {
        $deletedCount = 0;
        $tempDir = self::TEMP_UPLOAD_DIR;
        
        try {
            $files = Storage::disk(self::PUBLIC_DISK)->files($tempDir);
            $cutoffTime = now()->subMinutes($olderThanMinutes);
            
            foreach ($files as $file) {
                $lastModified = Storage::disk(self::PUBLIC_DISK)->lastModified($file);
                
                if ($lastModified < $cutoffTime->timestamp) {
                    if (Storage::disk(self::PUBLIC_DISK)->delete($file)) {
                        $deletedCount++;
                    }
                }
            }
            
            Log::info('Cleaned up old temporary files', [
                'deleted_count' => $deletedCount,
                'older_than_minutes' => $olderThanMinutes
            ]);
            
        } catch (\Exception $e) {
            Log::error('Failed to cleanup old temporary files', [
                'error' => $e->getMessage()
            ]);
        }
        
        return $deletedCount;
    }
}
