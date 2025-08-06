<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Enums\CategoryType;
use App\Models\Category;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;

use App\Models\Media;
use App\Helpers\ImageHelper;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use App\Services\CloudinaryService;


class PortfolioController extends Controller
{   
    private Portfolio $model;

    private const PER_PAGE = 5;

    public function __construct()
    {
        $this->model = new Portfolio();
    }

    public function index(Request $request)
    {
        $search = $request->input('q');
        $selectedYear = $request->input('year');
        $categoryId = $request->input('category_id');

        $query = $this->model::with(['category.parent']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('client', 'like', "%{$search}%");
            });
        }

        if ($selectedYear) {
            $query->where('year', $selectedYear);
        }

        // Lọc theo danh mục (bao gồm cả cha và con)
        if ($request->filled('category_id')) {
            $categoryIds = Category::where('id', $categoryId)
                ->orWhere('parent_id', $categoryId)
                ->pluck('id');

            $query->whereIn('category_id', $categoryIds);
        }

        $portfolios = $query->latest()->paginate(self::PER_PAGE)
        ->appends([
            'q' => $request->q,
            'year' => $request->year,
            'category_id' => $request->category_id,
        ]);

        $categories = Category::with('children')
            ->where('type', CategoryType::PORTFOLIO)
            ->whereNull('parent_id')
            ->get();

        return view('admins.portfolios.index', [
            'portfolios' => $portfolios,
            'categories' => $categories,
            'selectedYear' => $selectedYear
        ]);
    }


    public function create()
    {
        $categories = Category::with('children')
            ->where('type', CategoryType::PORTFOLIO->value)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('admins.portfolios.create', compact('categories'));
    }


    public function store(StorePortfolioRequest $request, CloudinaryService $cloudinaryService)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('thumbnail')) {
            $uploadResult = $cloudinaryService
                ->upload($request->file('thumbnail'), 'portfolios');

            $validated['thumbnail'] = $uploadResult['url'];
        }

        $portfolio = $this->model::create($validated);

        if (!empty($validated['category_ids'])) {
            $portfolio->categories()->sync($validated['category_ids']);
        }

        $result = ImageHelper::extractAndUploadBase64Images($validated['content'] ?? '');
        $validated['content'] = $result['content'];
        $usedPaths = $result['paths'];

        Media::whereNull('mediaable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPaths)
            ->update([
                'mediaable_id' => $portfolio->id,
                'mediaable_type' => Portfolio::class,
            ]);

            
        return redirect()->route('admin.portfolios.index');
    }

    public function edit($id)
    {
        $portfolio = $this->model::findOrFail($id);

        $categories = Category::with('children')
            ->where('type', CategoryType::PORTFOLIO->value)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('admins.portfolios.edit', compact(
            'portfolio',
            'categories',
        ));
    }

    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio, CloudinaryService $cloudinaryService)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            if ($portfolio->thumbnail_public_id) {
                $cloudinaryService->delete($portfolio->thumbnail_public_id);
            }

            $uploadResult = $cloudinaryService->upload($request->file('thumbnail'), 'portfolios');

            $data['thumbnail'] = $uploadResult['url'] ?? null; // Đảm bảo đúng key như store()
            $data['thumbnail_public_id'] = $uploadResult['public_id'] ?? null;
        } else {
            // Rất quan trọng: giữ nguyên ảnh cũ nếu không upload ảnh mới
            $data['thumbnail'] = $portfolio->thumbnail;
            $data['thumbnail_public_id'] = $portfolio->thumbnail_public_id;
        }

        $result = ImageHelper::extractAndUploadBase64Images($data['content'] ?? '');
        $data['content'] = $result['content'];
        $usedPaths = $result['paths'];

        Media::whereNull('mediaable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPaths)
            ->update([
                'mediaable_id' => $portfolio->id,
                'mediaable_type' => Portfolio::class,
            ]);

        $portfolio->update($data);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Cập nhật thành công!');
    }


    public function show(Portfolio $portfolio)
    {
        $portfolio->load('media');

        return view('admins.portfolios.show', [
            'portfolio' => $portfolio,
        ]);
    }


    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->thumbnail_public_id) {
            Cloudinary::destroy($portfolio->thumbnail_public_id);
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')
        ->with('success', 'Xoá bài viết thành công.');
    }
}
