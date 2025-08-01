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
            $validated['image'] = $request->file('image')
            ->store('portfolio', 'public');
        }

        $portfolio = $this->model::create($validated);

        if (!empty($validated['category_ids'])) {
            $portfolio->categories()->sync($validated['category_ids']);
        }

        // $content = $validated['content'] ?? '';
        // preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches);
        // $usedImageUrls = $matches[1] ?? [];

        // $usedPaths = collect($usedImageUrls)->map(function ($url) {
        //     return str_replace(asset('storage') . '/', '', $url);
        // })->toArray();

        // $usedPaths = collect($usedImageUrls)->map(function ($url) {
        //     $relative = str_replace(asset('storage') . '/', '', $url);
        //     return trim($relative);
        // })->toArray();

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

    public function update(UpdatePortfolioRequest $request, $id)
    {
        $portfolio = $this->model::findOrFail($id);

        $validated = $request->validated();

        // Xử lý ảnh content trước khi fill content vào portfolio
        $result = ImageHelper::extractAndUploadBase64Images($validated['content'] ?? '');
        $validated['content'] = $result['content'];
        $usedPaths = $result['paths'];

        $portfolio->fill([
            'name' => $validated['name'],
            'location' => $validated['location'],
            'client' => $validated['client'] ?? null,
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'category_id' => $validated['category_id'],
            'year' => $validated['year'] ?? null,
            'content' => $validated['content'],
        ]);

        // Xử lý ảnh đại diện
        if ($request->hasFile('image_new')) {
            if ($portfolio->image && Storage::exists('public/' . $portfolio->image)) {
                Storage::delete('public/' . $portfolio->image);
            }

            $portfolio->image = $request->file('image_new')->store('portfolio', 'public');
        }

        $portfolio->save();

        // XÓA ảnh cũ đã gắn với portfolio nhưng không còn dùng trong content
        Media::where('mediable_id', $portfolio->id)
            ->where('mediable_type', Portfolio::class)
            ->where('type', 'image')
            ->whereNotIn('file_path', $usedPaths)
            ->each(function ($media) {
                if (Storage::disk('public')->exists($media->file_path)) {
                    Storage::disk('public')->delete($media->file_path);
                }
                $media->delete();
            });

        // GẮN ảnh mới (đang tạm thời chưa liên kết) vào portfolio
        Media::whereNull('mediable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPaths)
            ->update([
                'mediable_id' => $portfolio->id,
                'mediable_type' => Portfolio::class,
            ]);

        return redirect()->route('admin.portfolios.index');
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
        if ($portfolio->image && Storage::exists('public/' . $portfolio->image)) {
            Storage::delete('public/' . $portfolio->image);
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')
        ->with('success', 'Xoá bài viết thành công.');
    }
}
