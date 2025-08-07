<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Services\CloudinaryService;

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

        $partners = $this->model->query()
        ->where(function ($query) use ($search) {
            if ($search) {
                $query->where('name', 'like', "%{$search}%");
            }
        })
        ->orderBy('id', 'desc')
        ->paginate(self::PER_PAGE);
        
        return view('admins.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new partner.
     *
     * @return \Illuminate\View\View
     */

    public function create()
    {
        return view('admins.partners.create');
    }

    public function store(StorePartnerRequest $request, CloudinaryService $cloudinaryService)
    {
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            $uploadResult = $cloudinaryService->upload($request->file('logo'), 'partners');

            $validated['logo'] = $uploadResult['url'] ?? null;
            $validated['logo_public_id'] = $uploadResult['path'] ?? null; // dùng path làm public_id
        }

        $this->model::create($validated);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Thêm đối tác thành công!');
    }

    public function edit($id)
    {
        $partner = $this->model->findOrFail($id);
        return view('admins.partners.edit', compact('partner'));
    }

    public function update(UpdatePartnerRequest $request, Partner $partner, CloudinaryService $cloudinaryService)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            // Nếu có ảnh cũ → xoá
            if ($partner->logo_public_id) {
                $cloudinaryService->delete($partner->logo_public_id);
            }

            // Upload ảnh mới
            $uploadResult = $cloudinaryService->upload($request->file('logo'), 'partners');

            $data['logo'] = $uploadResult['url'] ?? null;
            $data['logo_public_id'] = $uploadResult['path'] ?? null;
        } else {
            // Nếu không upload ảnh mới → giữ nguyên ảnh cũ
            $data['logo'] = $partner->logo;
            $data['logo_public_id'] = $partner->logo_public_id;
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        $partner = $this->model->findOrFail($id);

        if ($partner->logo_public_id) {
            app(CloudinaryService::class)
                ->delete($partner->logo_public_id);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Đã xoá đối tác thành công!');
    }
}
