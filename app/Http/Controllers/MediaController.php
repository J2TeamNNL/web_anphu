<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MediaController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // tối đa 5MB
        ]);

        try {
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();

            $media = Media::create([
                'url' => $uploadedFileUrl,
                'type' => 'image',
            ]);

            return response()->json(['success' => true, 'url' => $media->url]);
        } catch (\Exception $e) {
            Log::error('Upload failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Upload failed.'], 500);
        }
    }
}