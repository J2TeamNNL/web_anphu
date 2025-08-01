<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

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
        $partners = $this->model->orderBy('id', 'desc')->paginate(self::PER_PAGE);
        return view('admins.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admins.partners.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = Str::random(20) . '.' . $logo->getClientOriginalExtension();
            $path = public_path('uploads/logo');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            $logo->move($path, $filename);

            // ✅ Lưu đường dẫn đầy đủ
            $data['logo'] = URL::to('/') . '/uploads/logo/' . $filename;
        }

        $this->model->create($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Tạo mới thành công');
    }

    public function edit($id)
    {
        $partner = $this->model->findOrFail($id);
        return view('admins.partners.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $partner = $this->model->findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('logo_new')) {
            // Xoá ảnh cũ nếu có
            if ($partner->logo) {
                $oldFile = public_path(parse_url($partner->logo, PHP_URL_PATH));
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            // Upload ảnh mới
            $logo = $request->file('logo_new');
            $filename = Str::random(20) . '.' . $logo->getClientOriginalExtension();
            $path = public_path('uploads/logo');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            $logo->move($path, $filename);
            $data['logo'] = URL::to('/') . '/uploads/logo/' . $filename;
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        $partner = $this->model->findOrFail($id);

        if ($partner->logo) {
            $logoPath = public_path(parse_url($partner->logo, PHP_URL_PATH));
            if (File::exists($logoPath)) {
                File::delete($logoPath);
            }
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Xóa thành công');
    }
}
