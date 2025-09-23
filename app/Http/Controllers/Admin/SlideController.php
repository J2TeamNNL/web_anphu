<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;

class SlideController extends Controller
{
    public function __construct(private ImageUploadService $imageUploadService)
    {
        //
    }
    
    public function index()
    {
        $slides = Slide::with('media')->get();
        return view('admins.slides.index', compact('slides'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Truncate all slides and their media
        $this->truncateAllSlides();

        // Create new slides with uploaded images
        foreach ($request->file('images') as $index => $image) {
            $slide = Slide::create();
            
            // Upload image using ImageUploadService
            $media = $this->imageUploadService->uploadImage($image, 'slides');
            
            // Update media with slide relationship and order
            $media->update([
                'order' => $index,
                'mediaable_id' => $slide->id,
                'mediaable_type' => Slide::class,
            ]);
        }

        return redirect()->route('admin.slides.index')->with('success', 'Slides đã được cập nhật thành công!');
    }

    private function truncateAllSlides()
    {
        $slides = Slide::with('media')->get();
        
        foreach ($slides as $slide) {
            $slide->media->delete();
            $slide->delete();
        }
    }

    public function destroy(Slide $slide)
    {
        $slide->media->delete();
        $slide->delete();
        return redirect()->route('admin.slides.index')->with('success', 'Slide đã được xóa thành công!');
    }
}
