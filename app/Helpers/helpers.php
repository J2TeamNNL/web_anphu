<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Helpers\CompanyHelper;

if (!function_exists('isActive')) {
    function isActive($routes, $class = 'active') {
        $current = Route::currentRouteName();

        if (is_array($routes) && in_array($current, $routes)) return $class;
        if (is_string($routes) && $current === $routes) return $class;

        return '';
    }
}

if (!function_exists('uploadImageToCloudinary')) {
    function uploadImageToCloudinary($file, $folder = 'uploads')
    {
        $cloudinary = new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
        ]);

        $result = $cloudinary->uploadApi()->upload($file->getRealPath(), [
            'folder' => $folder,
            'resource_type' => 'auto',
        ]);

        return $result;
    }
}

if (!function_exists('company')) {
    function company()
    {
        return CompanyHelper::getCompanySetting();
    }
}

if (!function_exists('htmlToPlainText')) {
    function htmlToPlainText($html, int $limit = 50)
    {
        // Loại bỏ thẻ HTML
        $text = strip_tags($html);
        
        // Chuyển đổi HTML entities thành ký tự thường
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // Loại bỏ khoảng trắng thừa
        $text = preg_replace('/\s+/', ' ', $text);
        $text = trim($text);
        
        return Str::limit($text, $limit);
    }
}
