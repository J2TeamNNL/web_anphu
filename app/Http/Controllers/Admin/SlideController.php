<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Services\CloudinaryService;
use App\Helpers\ImageHelper;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::with('media')->get();
        return view('admins.slides.index', compact('slides'));
    }

    public function store(Request $request, CloudinaryService $cloudinaryService)
    {
        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Truncate all slides and their media
        $this->truncateAllSlides($cloudinaryService);

        // Create new slides with uploaded images
        foreach ($request->file('images') as $index => $image) {
            $slide = Slide::create();
            
            $mediaData = ImageHelper::uploadToCloudinary($image, $cloudinaryService);
            
            Media::create([
                'file_path' => $mediaData['file_path'],
                'url' => $mediaData['url'],
                'public_id' => $mediaData['public_id'],
                'type' => 'image',
                'order' => $index,
                'mediaable_id' => $slide->id,
                'mediaable_type' => Slide::class,
            ]);
        }

        return redirect()->route('slides.index')->with('success', 'Slides đã được cập nhật thành công!');
    }

    private function truncateAllSlides(CloudinaryService $cloudinaryService)
    {
        $slides = Slide::with('media')->get();
        
        foreach ($slides as $slide) {
            foreach ($slide->media as $media) {
                ImageHelper::deleteFromCloudinary($media->public_id, $cloudinaryService);
                $media->delete();
            }
            $slide->delete();
        }
    }
}
