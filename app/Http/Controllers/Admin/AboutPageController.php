<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function index()
    {
        $aboutPages = AboutPage::latest()->get();
        return view('admins.about-pages.index', compact('aboutPages'));
    }

    public function create()
    {
        return view('admins.about-pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'required|string',
        ]);

        $data = $request->only(['title', 'content', 'description']);

        AboutPage::create($data);

        return redirect()->route('admin.about-pages.index')->with('success', 'Trang giới thiệu đã được tạo thành công!');
    }

    public function edit(AboutPage $aboutPage)
    {
        return view('admins.about-pages.edit', compact('aboutPage'));
    }

    public function update(Request $request, AboutPage $aboutPage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'required|string',
        ]);

        $data = $request->only(['title', 'content', 'description']);

        $aboutPage->update($data);

        return redirect()->route('admin.about-pages.index')->with('success', 'Trang giới thiệu đã được cập nhật thành công!');
    }

    public function destroy(AboutPage $aboutPage)
    {
        $aboutPage->delete();

        return redirect()->route('admin.about-pages.index')->with('success', 'Trang giới thiệu đã được xóa thành công!');
    }
}
