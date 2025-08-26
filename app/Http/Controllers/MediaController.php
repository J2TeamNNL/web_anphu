<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use App\Services\ImageUploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\UploadedFile;

class MediaController extends Controller
{
    protected ImageUploadService $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
        $this->middleware('auth');
    }

    /**
     * Fetch remote image by URL (server-side) and store via existing upload pipeline.
     * Returns a stable proxy URL (e.g., /media/{id}).
     */
    public function fetchRemote(Request $request): JsonResponse
    {
        $data = $request->validate([
            'url' => ['required', 'url'],
            'table' => ['required', 'string'],
        ]);

        try {
            // Download the image server-side (no browser CORS restrictions)
            $response = Http::timeout(15)->get($data['url']);

            if (!$response->ok()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tải được ảnh từ URL (HTTP ' . $response->status() . ')',
                ], 422);
            }

            $contentType = $response->header('Content-Type') ?? 'application/octet-stream';
            if (!preg_match('#^image/(jpeg|png|gif|webp)$#i', $contentType)) {
                return response()->json([
                    'success' => false,
                    'message' => 'URL không trỏ đến ảnh hợp lệ',
                ], 422);
            }

            // Create a temporary file and wrap as UploadedFile
            $extension = match (true) {
                str_contains(strtolower($contentType), 'jpeg') => 'jpg',
                str_contains(strtolower($contentType), 'png') => 'png',
                str_contains(strtolower($contentType), 'gif') => 'gif',
                str_contains(strtolower($contentType), 'webp') => 'webp',
                default => 'img',
            };

            $tmpPath = tempnam(sys_get_temp_dir(), 'remote_img_');
            file_put_contents($tmpPath, $response->body());
            $originalName = 'remote.' . $extension;

            $uploaded = new UploadedFile(
                $tmpPath,
                $originalName,
                $contentType,
                null,
                true // $test mode, skip is_uploaded_file check
            );

            $media = $this->imageUploadService->uploadImage($uploaded, $data['table']);

            return response()->json([
                'success' => true,
                'url' => $media->url,
            ]);

        } catch (\Throwable $e) {
            Log::error('Fetch remote image failed', [
                'error' => $e->getMessage(),
                'url' => $data['url'] ?? null,
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Không thể tải ảnh từ URL. Vui lòng thử lại.',
            ], 500);
        }
    }

    public function uploadImage(UploadImageRequest $request): JsonResponse
    {
        try {
            $media = $this->imageUploadService->uploadImage(
                file: $request->file('image'),
                table: $request->input('table')
            );

            return response()->json([
                'success' => true,
                'url' => $media->url,
            ]);

        } catch (\Exception $e) {
            Log::error('Image upload failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
