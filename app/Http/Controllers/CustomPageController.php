<?php

namespace App\Http\Controllers;

use App\Models\CustomPage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomPageRequest;
use App\Http\Requests\UpdateCustomPageRequest;
use App\Services\CloudinaryService;
use App\Models\Media;
use App\Helpers\ImageHelper;
use Illuminate\Support\Str;

class CustomPageController extends Controller
{
    private CustomPage $model;
    private const PER_PAGE = 10;

    public function __construct()
    {
        $this->model = new CustomPage();
    }

    public function index(Request $request)
    {
        $search = $request->input('q');

        $pages = $this->model->query()
            ->when($search, fn($query) => $query
                ->where('name', 'like', "%{$search}%"))
            ->orderBy('id', 'desc')
            ->paginate(self::PER_PAGE);

        return view('admins.custom_pages.index', compact(
            'pages', 
            'search'
        ));
    }

    public function create()
    {
        return view('admins.custom_pages.create');
    }

    public function store(StoreCustomPageRequest $request, CloudinaryService $cloudinaryService)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title_1'] ?? 'page');
        }

        for ($i = 1; $i <= 4; $i++) {
            $imageKey = "image_{$i}";
            $imagePublicKey = "image_{$i}_public_id";

            if ($request->hasFile($imageKey)) {
                $uploadResult = $cloudinaryService
                    ->upload($request->file($imageKey), 'custom_pages');
                $data[$imageKey] = $uploadResult['url'] ?? null;
                $data[$imagePublicKey] = $uploadResult['path'] ?? null;
            }
        }

        // Xử lý custom_content (có thể có base64 image)
        $usedPaths = [];
        for ($i = 1; $i <= 4; $i++) {
            $contentKey = "custom_content_{$i}";
            if (!empty($data[$contentKey])) {
                $result = ImageHelper::extractAndUploadBase64Images($data[$contentKey]);
                $data[$contentKey] = $result['content'];
                $usedPaths = array_merge($usedPaths, $result['paths']);
            }
        }

        $page = $this->model::create($data);

        // Cập nhật Media
        Media::whereNull('mediaable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPaths)
            ->update([
                'mediaable_id' => $page->id,
                'mediaable_type' => CustomPage::class,
            ]);

        return redirect()->route('admin.custom_pages.index')
            ->with('success', 'Tạo trang thành công!');
    }

    public function edit($id)
    {
        $page = $this->model->findOrFail($id);
        return view('admins.custom_pages.edit', compact('page'));
    }

    public function update(UpdateCustomPageRequest $request, CustomPage $customPage, CloudinaryService $cloudinaryService)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title_1'] ?? $customPage->title_1);
        }

        for ($i = 1; $i <= 4; $i++) {
            $imageKey = "image_{$i}";
            $imagePublicKey = "image_{$i}_public_id";

            if ($request->hasFile($imageKey)) {
                if ($customPage->$imagePublicKey) {
                    $cloudinaryService->delete($customPage->$imagePublicKey);
                }
                $uploadResult = $cloudinaryService->upload($request->file($imageKey), 'custom_pages');
                $data[$imageKey] = $uploadResult['url'] ?? null;
                $data[$imagePublicKey] = $uploadResult['path'] ?? null;
            } else {
                $data[$imageKey] = $customPage->$imageKey;
                $data[$imagePublicKey] = $customPage->$imagePublicKey;
            }
        }

        // Xử lý custom_content
        $usedPaths = [];
        for ($i = 1; $i <= 4; $i++) {
            $contentKey = "custom_content_{$i}";
            if (!empty($data[$contentKey])) {
                $result = ImageHelper::extractAndUploadBase64Images($data[$contentKey]);
                $data[$contentKey] = $result['content'];
                $usedPaths = array_merge($usedPaths, $result['paths']);
            } else {
                $data[$contentKey] = $customPage->$contentKey;
            }
        }

        // Cập nhật Media
        Media::whereNull('mediaable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPaths)
            ->update([
                'mediaable_id' => $customPage->id,
                'mediaable_type' => CustomPage::class,
            ]);

        $customPage->update($data);

        return redirect()->route('admin.custom_pages.index')
            ->with('success', 'Cập nhật trang thành công!');
    }

    public function destroy(CustomPage $customPage)
    {
        $cloudinaryService = app(CloudinaryService::class);

        // Xóa ảnh image_1_public_id → image_4_public_id
        for ($i = 1; $i <= 4; $i++) {
            $imagePublicIdKey = "image_{$i}_public_id";
            if (!empty($customPage->$imagePublicIdKey)) {
                $cloudinaryService->delete($customPage->$imagePublicIdKey);
            }
        }

        // Xóa ảnh trong custom_content_1 → custom_content_4
        for ($i = 1; $i <= 4; $i++) {
            $contentKey = "custom_content_{$i}";
            if (!empty($customPage->$contentKey)) {
                // Lấy tất cả public_id từ HTML
                preg_match_all('/upload\/(?:v\d+\/)?([^\.]+)\.[a-zA-Z0-9]+/', $customPage->$contentKey, $matches);
                if (!empty($matches[1])) {
                    foreach ($matches[1] as $publicId) {
                        $cloudinaryService->delete($publicId);
                    }
                }
            }
        }

        $customPage->delete();

        return redirect()->route('admin.custom_pages.index')
            ->with('success', 'Xoá trang thành công!');
    }

    public function show(CustomPage $customPage)
    {
        return view('admins.custom_pages.show', compact('customPage'));
    }
}
