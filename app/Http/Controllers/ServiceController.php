<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Services\CloudinaryService;
use Illuminate\Support\Str;

use App\Models\Media;
use App\Helpers\ImageHelper;

class ServiceController extends Controller
{
    private Service $model;
    private const PER_PAGE = 6;

    public function __construct()
    {
        $this->model = new Service();
    }

    public function index(Request $request)
    {
        $search = $request->input('q');

        $services = $this->model->query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(self::PER_PAGE);

        return view('admins.services.index', compact('services', 'search'));
    }

    public function create()
    {
        return view('admins.services.create');
    }

    public function store(StoreServiceRequest $request, CloudinaryService $cloudinaryService)
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('image')) {
            $uploadResult = $cloudinaryService->upload($request->file('image'), 'services');
            $validated['image'] = $uploadResult['url'] ?? null;
            $validated['image_public_id'] = $uploadResult['path'] ?? null;
        }

        for ($i = 1; $i <= 4; $i++) {
            $iconKey = "icon_{$i}";
            if ($request->hasFile($iconKey)) {
                $uploadResult = $cloudinaryService->upload($request->file($iconKey), 'services/icons');
                $validated[$iconKey] = $uploadResult['url'] ?? null;
                $validated["{$iconKey}_public_id"] = $uploadResult['path'] ?? null;
            }
        }

        // Xử lý content_price
        $resultPrice = ImageHelper::extractAndUploadBase64Images($validated['content_price'] ?? '');
        $validated['content_price'] = $resultPrice['content'];
        $usedPathsPrice = $resultPrice['paths'];

        // Xử lý content_service
        $resultService = ImageHelper::extractAndUploadBase64Images($validated['content_service'] ?? '');
        $validated['content_service'] = $resultService['content'];
        $usedPathsService = $resultService['paths'];

        $service = $this->model::create($validated);

        // Cập nhật media cho content_price
        Media::whereNull('mediaable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPathsPrice)
            ->update([
                'mediaable_id' => $service->id,
                'mediaable_type' => Service::class,
            ]);

        // Cập nhật media cho content_service
        Media::whereNull('mediaable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPathsService)
            ->update([
                'mediaable_id' => $service->id,
                'mediaable_type' => Service::class,
            ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Thêm dịch vụ thành công!');
    }

    public function edit($id)
    {
        $service = $this->model->findOrFail($id);
        return view('admins.services.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service, CloudinaryService $cloudinaryService)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name'] ?? $service->name);
        }

        if ($request->hasFile('image')) {
            if ($service->image_public_id) {
                $cloudinaryService->delete($service->image_public_id);
            }
            $uploadResult = $cloudinaryService->upload($request->file('image'), 'services');
            $data['image'] = $uploadResult['url'] ?? null;
            $data['image_public_id'] = $uploadResult['path'] ?? null;
        } else {
            $data['image'] = $service->image;
            $data['image_public_id'] = $service->image_public_id;
        }

        for ($i = 1; $i <= 4; $i++) {
            $iconKey = "icon_{$i}";
            $iconPublicIdKey = "{$iconKey}_public_id";

            if ($request->hasFile($iconKey)) {
                if ($service->$iconPublicIdKey) {
                    $cloudinaryService->delete($service->$iconPublicIdKey);
                }
                $uploadResult = $cloudinaryService->upload($request->file($iconKey), 'services/icons');
                $data[$iconKey] = $uploadResult['url'] ?? null;
                $data[$iconPublicIdKey] = $uploadResult['path'] ?? null;
            } else {
                $data[$iconKey] = $service->$iconKey;
                $data[$iconPublicIdKey] = $service->$iconPublicIdKey;
            }
        }

        // Xử lý content_price
        $resultPrice = ImageHelper::extractAndUploadBase64Images($data['content_price'] ?? '');
        $data['content_price'] = $resultPrice['content'];
        $usedPathsPrice = $resultPrice['paths'];

        // Xử lý content_service
        $resultService = ImageHelper::extractAndUploadBase64Images($data['content_service'] ?? '');
        $data['content_service'] = $resultService['content'];
        $usedPathsService = $resultService['paths'];

        Media::whereNull('mediaable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPathsPrice)
            ->update([
                'mediaable_id' => $service->id,
                'mediaable_type' => Service::class,
            ]);

        Media::whereNull('mediaable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPathsService)
            ->update([
                'mediaable_id' => $service->id,
                'mediaable_type' => Service::class,
            ]);

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'Cập nhật dịch vụ thành công!');
    }

    public function show(Service $service)
    {   
        return view('customers.partials.detail', compact('service'));
    }

    public function destroy(Service $service)
    {   
        $cloudinaryService = app(CloudinaryService::class);
        
        if ($service->image_public_id) {
            app(CloudinaryService::class)->delete($service->image_public_id);
        }

        for ($i = 1; $i <= 4; $i++) {
            $iconPublicIdKey = "icon_{$i}_public_id";
            if ($service->$iconPublicIdKey) {
                $cloudinaryService->delete($service->$iconPublicIdKey);
            }
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Đã xoá dịch vụ thành công!');
    }
}
