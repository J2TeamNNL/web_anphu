<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use App\Services\ImageUploadService;
use Illuminate\Http\JsonResponse;

class MediaController extends Controller
{
    protected ImageUploadService $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    /**
     * Upload image via AJAX for Quill editor.
     */
    public function uploadImage(UploadImageRequest $request): JsonResponse
    {
        $url = $this->imageUploadService->uploadImage(
            $request->file('image'),
            $request->input('table')
        );

        return response()->json([
            'success' => true,
            'url' => $url
        ]);
    }
}