<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use Illuminate\Support\Str;

class ImageHelper
{
    public static function extractAndUploadBase64Images(string $content, string $folder = 'uploads/portfolios')
    {
        $base64Pattern = '/<img[^>]+src="data:image\/(png|jpeg|jpg|gif);base64,([^">]+)"/i';
        $urlPattern = '/<img[^>]+src="([^">]+)"/i';

        $updatedContent = $content;
        $usedPaths = [];

        // 1. Xử lý ảnh base64
        if (preg_match_all($base64Pattern, $content, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $extension = $match[1];
                $base64Data = $match[2];

                $decodedData = base64_decode($base64Data);
                if (!$decodedData) continue;

                $filename = $folder . '/' . Str::random(40) . '.' . $extension;
                Storage::disk('public')->put($filename, $decodedData);

                Media::create([
                    'file_path' => $filename,
                    'type' => 'image',
                ]);

                $url = asset('storage/' . $filename);
                $usedPaths[] = $filename;

                // Thay thế trong nội dung
                $originalTag = $match[0];
                $newTag = str_replace($match[0], '<img src="' . $url . '"', $originalTag);
                $updatedContent = str_replace($originalTag, $newTag, $updatedContent);
            }
        }

        // 2. Lấy ra các URL ảnh hiện có
        if (preg_match_all($urlPattern, $updatedContent, $matches)) {
            foreach ($matches[1] as $url) {
                if (Str::startsWith($url, asset('storage'))) {
                    $relativePath = str_replace(asset('storage') . '/', '', $url);
                    $usedPaths[] = $relativePath;
                }
            }
        }

        return [
            'content' => $updatedContent,
            'paths' => array_unique($usedPaths),
        ];
    }

}
