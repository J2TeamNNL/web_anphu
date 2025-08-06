<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use App\Services\ImageUploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    protected ImageUploadService $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
        $this->middleware('auth');
    }

    /**
     * Upload image via AJAX for Quill editor.
     */
    public function uploadImage(UploadImageRequest $request): JsonResponse
    {
        try {
            Log::info('Upload request received', [
                'table' => $request->input('table'),
                'file' => $request->file('image') ? $request->file('image')->getClientOriginalName() : null,
            ]);

            $media = $this->imageUploadService->uploadImage(
                file: $request->file('image'),
                table: $request->input('table')
            );

            return response()->json([
                'success' => true,
                'url' => $media->url, // 👈 Thêm dòng này để Quill lấy trực tiếp
                'media' => [
                    'id' => $media->id,
                    'url' => $media->url,
                    'public_id' => $media->public_id,
                ],
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
