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
                return response()->json(['error' => 'No file uploaded.'], 400);
            }

            $file = $request->file('upload');

            if (!$file->isValid()) {
                return response()->json(['error' => 'Invalid file.'], 400);
            }

            $table = $request->query('table', 'articles'); // mặc định là articles
            
            $folder = in_array($table, ['articles', 'portfolios']) ? $table : 'misc';

            $path = $file->store("uploads/{$folder}", 'public');

            Media::create([
                'file_path' => $path,
                'type' => 'image',
            ]);

            return response()->json([
                'url' => asset('storage/' . $path),
                'uploaded' => 1,
                'fileName' => $file->getClientOriginalName(),
            ]);
        } catch (\Exception $e) {
            Log::error('Upload image failed: ' . $e->getMessage());
            return response()->json(['error' => 'Upload failed.'], 500);
        }
    }
}
