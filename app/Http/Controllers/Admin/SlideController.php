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
            'image' => 'required|image'
        ]);

        $slide = Slide::create();
        
        $media = $this->imageUploadService->uploadImage($request->file('image'), 'slides');
        
        $media->update([
            'mediaable_id' => $slide->id,
            'mediaable_type' => Slide::class,
        ]);

        return redirect()->route('admin.slides.index')->with('success', 'Slide mới đã được thêm thành công!');
    }

    public function destroy(Slide $slide)
    {
        $slide->media->delete();
        $slide->delete();
        return redirect()->route('admin.slides.index')->with('success', 'Slide đã được xóa thành công!');
    }
}
