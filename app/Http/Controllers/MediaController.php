<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    public function uploadImage(Request $request)
    {
        try {
            if (!$request->hasFile('upload')) {
                return response()->json(['error' => ['message' => 'No file uploaded.']], 400);
            }

            $file = $request->file('upload');

            if (!$file) {
                Log::error('No file received. Keys: ' . json_encode($request->all()));
                return response()->json(['error' => ['message' => 'No file uploaded.']], 400);
            }

            if (!$file->isValid()) {
                return response()->json(['error' => ['message' => 'Invalid file.']], 400);
            }

            $table = $request->query('table', 'articles');
            $folder = in_array($table, ['articles', 'portfolios']) ? $table : 'misc';

            $path = $file->store("uploads/{$folder}", 'public');

            Media::create([
                'file_path' => $path,
                'type' => 'image',
            ]);

            return response()->json([
                'uploaded' => true,
                'url' => asset('storage/' . $path)
            ]);
        } catch (\Exception $e) {
            Log::error('Upload image failed: ' . $e->getMessage());
            return response()->json(['error' => ['message' => 'Upload failed.']], 500);
        }
    }
}
