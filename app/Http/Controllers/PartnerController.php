<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    private const PER_PAGE = 6;

    public function index()
    {
        $partners = Partner::latest()
            ->orderBy('name', 'asc')
            ->paginate(self::PER_PAGE);

        return view('admins.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admins.partners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logo', 'public');
            // -> lưu vào storage/app/public/logo
        }

        Partner::create($validated);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Thêm Đối tác thành công');
    }

    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admins.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:partners,name,' . $partner->id,
            'link' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // Xóa ảnh cũ
            if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }

            $validated['logo'] = $request->file('logo')->store('logo', 'public');
        }

        $partner->update($validated);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Cập nhật đối tác thành công');
    }

    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);

        if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Xóa đối tác thành công');
    }
}
