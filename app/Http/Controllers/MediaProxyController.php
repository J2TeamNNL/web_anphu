<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Services\MediaStorageService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class MediaProxyController extends Controller
{
    protected MediaStorageService $storageService;

    public function __construct(MediaStorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    public function serve(Media $media)
    {
        // If file_path contains cloudinary, redirect to Cloudinary
        if ($this->storageService->isCloudinaryUrl($media->file_path)) {
            return redirect($media->file_path);
        }

        // If it's a local file, serve it directly
        if ($this->storageService->isLocalStorageUrl($media->file_path)) {
            $localPath = $this->storageService->extractLocalPathFromUrl($media->file_path);
            
            if ($localPath && $this->storageService->exists($localPath)) {
                $file = $this->storageService->getFileContent($localPath);
                $mimeType = $this->storageService->getMimeType($localPath);
                
                return response($file, 200)
                    ->header('Content-Type', $mimeType)
                    ->header('Cache-Control', 'public, max-age=3600');
            }
        }

        // If file not found anywhere
        abort(404, 'Media file not found');
    }
}
