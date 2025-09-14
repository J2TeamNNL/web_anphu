<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use RuntimeException;

class CloudinaryService
{
    protected string $cloudName;
    protected string $baseUrl;

    public function __construct()
    {
        $this->cloudName = config('cloudinary.cloud.cloud_name') ?? env('CLOUDINARY_CLOUD_NAME');
        $this->baseUrl = "https://res.cloudinary.com/{$this->cloudName}/image/upload";
    }

    /**
     * Upload file to Cloudinary using Storage disk.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param array $options
     * @return array
     * @throws \Exception
     */
    public function upload(UploadedFile $file, string $folder = 'uploads'): array
    {
        // Validate file
        if (!$file->isValid()) {
            throw new InvalidArgumentException('Invalid file upload: ' . $file->getErrorMessage());
        }

        // Check file size (max 10MB)
        if ($file->getSize() > 10 * 1024 * 1024) {
            throw new InvalidArgumentException('File size exceeds 10MB limit');
        }

        // Check file type
        $allowedMimes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'image/svg+xml',
            'image/svg',  // Some systems may use this MIME type for SVG
            'text/plain'  // SVG files sometimes detected as text/plain
        ];

        $fileMimeType = $file->getMimeType();

        // Additional check for SVG files detected as text/plain
        $isValidFile = in_array($fileMimeType, $allowedMimes);

        // If it's text/plain, verify it's actually an SVG by checking file extension
        if ($fileMimeType === 'text/plain') {
            $extension = strtolower($file->getClientOriginalExtension());
            $isValidFile = in_array($extension, ['svg']);
        }

        if (!$isValidFile) {
            throw new InvalidArgumentException("File type not allowed. Uploaded file has MIME type: {$fileMimeType}. Only JPEG, PNG, GIF, WebP, and SVG are supported");
        }

        // Generate unique filename
        $filename = $this->generateFilename($file, $folder);

        // Upload to Cloudinary using Storage disk
        $path = Storage::disk('cloudinary')->putFileAs('', $file, $filename);

        if (!$path) {
            throw new RuntimeException('Failed to upload file to Cloudinary storage');
        }

        return [
            'success' => true,
            'path' => $path,
            'url' => $this->getOptimizedUrl($path),
            'thumbnail' => $this->getThumbnailUrl($path),
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType()
        ];
    }

    /**
     * Delete file from Cloudinary.
     *
     * @param string $path
     * @return bool
     */
    public function delete(string $path): bool
    {
        if (empty($path)) {
            throw new InvalidArgumentException('File path cannot be empty');
        }

        return Storage::disk('cloudinary')->delete($path);
    }

    /**
     * Check if file exists on Cloudinary.
     *
     * @param string $path
     * @return bool
     */
    public function exists(string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        return Storage::disk('cloudinary')->exists($path);
    }

    /**
     * Get file size from Cloudinary.
     *
     * @param string $path
     * @return int|null
     */
    public function getSize(string $path): ?int
    {
        return Storage::disk('cloudinary')->size($path);
    }

    /**
     * Get last modified timestamp from Cloudinary.
     *
     * @param string $path
     * @return int|null
     */
    public function getLastModified(string $path): ?int
    {
        return Storage::disk('cloudinary')->lastModified($path);
    }

    /**
     * List all files in Cloudinary storage.
     *
     * @param string $directory
     * @return array
     */
    public function listFiles(string $directory = ''): array
    {
        $disk = Storage::disk('cloudinary');
        $files = $disk->allFiles($directory);

        $fileList = [];
        foreach ($files as $file) {
            $fileList[] = [
                'path' => $file,
                'url' => $this->getOptimizedUrl($file),
                'thumbnail' => $this->getThumbnailUrl($file),
                'size' => $disk->size($file),
                'last_modified' => $disk->lastModified($file)
            ];
        }

        return $fileList;
    }

    /**
     * Get file information including URLs and metadata.
     *
     * @param string $path
     * @return array
     * @throws RuntimeException
     */
    public function getFileInfo(string $path): array
    {
        if (empty($path)) {
            throw new InvalidArgumentException('File path cannot be empty');
        }

        $disk = Storage::disk('cloudinary');

        if (!$disk->exists($path)) {
            return [
                'exists' => false,
                'path' => $path
            ];
        }

        return [
            'exists' => true,
            'path' => $path,
            'url' => $this->getOptimizedUrl($path),
            'thumbnail' => $this->getThumbnailUrl($path),
            'size' => $disk->size($path),
            'last_modified' => $disk->lastModified($path),
            'transformations' => $this->getTransformationUrls($path)
        ];
    }

    /**
     * Generate Cloudinary URL with transformations.
     *
     * @param string $path
     * @param array $transformations
     * @return string
     */
    public function getUrl(string $path, array $transformations = []): string
    {
        if (empty($this->cloudName) || empty($path)) {
            return '';
        }

        $transformString = $this->buildTransformationString($transformations);

        return $this->baseUrl . $transformString . '/' . ltrim($path, '/');
    }

    /**
     * Get optimized URL with auto format and quality.
     *
     * @param string $path
     * @param array $additionalTransforms
     * @return string
     */
    public function getOptimizedUrl(string $path, array $additionalTransforms = []): string
    {
        $defaultTransforms = [
            'quality' => 'auto',
            'format' => 'auto'
        ];

        $transforms = array_merge($defaultTransforms, $additionalTransforms);

        return $this->getUrl($path, $transforms);
    }

    /**
     * Get thumbnail URL.
     *
     * @param string $path
     * @param int $width
     * @param int $height
     * @param string $crop
     * @return string
     */
    public function getThumbnailUrl(string $path, int $width = 200, int $height = 200, string $crop = 'fill'): string
    {
        return $this->getUrl($path, [
            'width' => $width,
            'height' => $height,
            'crop' => $crop,
            'quality' => 'auto'
        ]);
    }

    /**
     * Get resized image URL.
     *
     * @param string $path
     * @param int $width
     * @param int|null $height
     * @param string $crop
     * @return string
     */
    public function getResizedUrl(string $path, int $width, ?int $height = null, string $crop = 'scale'): string
    {
        $transformations = [
            'width' => $width,
            'crop' => $crop,
            'quality' => 'auto'
        ];

        if ($height) {
            $transformations['height'] = $height;
        }

        return $this->getUrl($path, $transformations);
    }

    /**
     * Get URL with effects.
     *
     * @param string $path
     * @param string $effect
     * @param array $additionalTransforms
     * @return string
     */
    public function getEffectUrl(string $path, string $effect, array $additionalTransforms = []): string
    {
        $transforms = array_merge(['effect' => $effect], $additionalTransforms);

        return $this->getUrl($path, $transforms);
    }

    /**
     * Get multiple transformation URLs for demo purposes.
     *
     * @param string $path
     * @return array
     */
    public function getTransformationUrls(string $path): array
    {
        return [
            'original' => $this->getOptimizedUrl($path),
            'thumbnail' => $this->getThumbnailUrl($path, 150, 150),
            'medium' => $this->getResizedUrl($path, 400, 300, 'fill'),
            'large' => $this->getResizedUrl($path, 800, 600, 'fill'),
            'sepia' => $this->getEffectUrl($path, 'sepia'),
            'grayscale' => $this->getEffectUrl($path, 'grayscale'),
            'blur' => $this->getEffectUrl($path, 'blur:300'),
            'rounded' => $this->getUrl($path, ['radius' => 'max', 'crop' => 'fill', 'width' => 200, 'height' => 200])
        ];
    }

    /**
     * Generate unique filename for upload.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param array $options
     * @return string
     */
    protected function generateFilename(UploadedFile $file, string $folder, array $options = []): string
    {
        $prefix = $options['prefix'] ?? 'upload';
        $timestamp = time();
        $uniqueId = uniqid();
        $extension = $file->getClientOriginalExtension();

        return "{$folder}/{$prefix}_{$timestamp}_{$uniqueId}.{$extension}";
    }

    /**
     * Build transformation string from array.
     *
     * @param array $transformations
     * @return string
     */
    protected function buildTransformationString(array $transformations): string
    {
        if (empty($transformations)) {
            return '';
        }

        $transformParts = [];

        foreach ($transformations as $key => $value) {
            switch ($key) {
                case 'width':
                    $transformParts[] = "w_{$value}";
                    break;
                case 'height':
                    $transformParts[] = "h_{$value}";
                    break;
                case 'crop':
                    $transformParts[] = "c_{$value}";
                    break;
                case 'quality':
                    $transformParts[] = "q_{$value}";
                    break;
                case 'format':
                    $transformParts[] = "f_{$value}";
                    break;
                case 'gravity':
                    $transformParts[] = "g_{$value}";
                    break;
                case 'radius':
                    $transformParts[] = "r_{$value}";
                    break;
                case 'effect':
                    $transformParts[] = "e_{$value}";
                    break;
                case 'angle':
                    $transformParts[] = "a_{$value}";
                    break;
                case 'opacity':
                    $transformParts[] = "o_{$value}";
                    break;
                default:
                    if (is_string($value)) {
                        $transformParts[] = "{$key}_{$value}";
                    }
            }
        }

        return !empty($transformParts) ? '/' . implode(',', $transformParts) : '';
    }

}
