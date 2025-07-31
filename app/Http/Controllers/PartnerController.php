<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
{   
    private Partner $model;

    private const PER_PAGE = 6;

    public function __construct()
    {
        $this->model = new Partner();
    }

    public function index(Request $request)
    {   
        $search = $request->input('q');

        $partners = $this->model::query()
            ->latest()
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
            $file = $request->file('logo');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('logo');

            // Tạo thư mục nếu chưa có
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $validated['logo'] = 'logo/' . $filename;
        }

        $this->model::create($validated);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Thêm Đối tác thành công');
    }

    public function edit($id)
    {
        $partner = $this->model::findOrFail($id);
        return view('admins.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $partner = $this->model::findOrFail($partner->id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:partners,name,' . $partner->id,
            'logo' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('logo_new')) {
            if ($partner->logo && file_exists(public_path($partner->logo))) {
                unlink(public_path($partner->logo));
            }

            $file = $request->file('logo_new');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('logo');

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $partner->logo = 'logo/' . $filename;
        } else {
            $partner->logo = $request->input('logo_old', $partner->logo);
        }

        $validated['logo'] = $partner->logo;

        $partner->update($validated);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Cập nhật đối tác thành công');
    }

    public function destroy($id)
    {
        $partner = $this->model::findOrFail($id);

        if ($partner->logo && file_exists(public_path($partner->logo))) {
            unlink(public_path($partner->logo));
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')
        ->with('success', 'Xóa giá thành công');
    }
}
