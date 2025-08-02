<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Enums\CategoryType;
use App\Models\Category;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;

use App\Models\Media;
use App\Helpers\ImageHelper;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


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


    public function store(StorePortfolioRequest $request)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'portfolios',
            ]);

            $validated['image'] = $uploadedFileUrl->getSecurePath();
            $validated['image_public_id'] = $uploadedFileUrl->getPublicId();
        }

        $portfolio = $this->model::create($validated);

        if (!empty($validated['category_ids'])) {
            $portfolio->categories()->sync($validated['category_ids']);
        }

        $result = ImageHelper::extractAndUploadBase64Images($validated['content'] ?? '');
        $validated['content'] = $result['content'];
        $usedPaths = $result['paths'];

        Media::whereNull('mediable_id')
        ->where('type', 'image')
        ->whereIn('file_path', $usedPaths)
        ->update([
            'mediable_id' => $portfolio->id,
            'mediable_type' => Portfolio::class,
        ]);

        return redirect()->route('admin.portfolios.index');

        // return response()->json($portfolio, 201);
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

    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio)
    {
        $data = $request->validated();

        // Nếu người dùng tải ảnh mới
        if ($request->hasFile('image_new')) {
            // Xóa ảnh cũ từ Cloudinary (nếu có public_id)
            if ($portfolio->image_public_id) {
                Cloudinary::destroy($portfolio->image_public_id);
            }

            $uploadedFileUrl = Cloudinary::upload($request->file('image_new')->getRealPath(), [
                'folder' => 'portfolios',
            ]);

            $data['image'] = $uploadedFileUrl->getSecurePath();
            $data['image_public_id'] = $uploadedFileUrl->getPublicId();
        }

        $result = ImageHelper::extractAndUploadBase64Images($data['content'] ?? '');
        $data['content'] = $result['content'];
        $usedPaths = $result['paths'];

        Media::whereNull('mediable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPaths)
            ->update([
                'mediable_id' => $portfolio->id,
                'mediable_type' => Portfolio::class,
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
        if ($portfolio->image_public_id) {
            Cloudinary::destroy($portfolio->image_public_id);
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')
        ->with('success', 'Xoá bài viết thành công.');
    }
}
