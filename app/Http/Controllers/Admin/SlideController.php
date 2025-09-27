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
            'image' => 'required|image',
            'is_mobile' => 'boolean'
        ]);

        $slide = Slide::create([
            'is_mobile' => $request->boolean('is_mobile', false)
        ]);
        
        $media = $this->imageUploadService->uploadImage($request->file('image'), 'slides');
        
        $media->update([
            'mediaable_id' => $slide->id,
            'mediaable_type' => Slide::class,
        ]);

        $slideType = $slide->is_mobile ? 'mobile' : 'desktop';
        return redirect()->route('admin.slides.index')->with('success', "Slide {$slideType} mới đã được thêm thành công!");
    }

    public function update(Request $request, Slide $slide)
    {
        $request->validate([
            'is_mobile' => 'boolean'
        ]);

        $slide->update([
            'is_mobile' => $request->boolean('is_mobile', false)
        ]);

        return redirect()->route('admin.slides.index')->with('success', "Slide đã được cập nhật thành {$slide->type}!");
    }

    public function destroy(Slide $slide)
    {
        $slide->media->delete();
        $slide->delete();
        return redirect()->route('admin.slides.index')->with('success', 'Slide đã được xóa thành công!');
    }
}
