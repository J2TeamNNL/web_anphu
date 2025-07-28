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

        $query = $this->model::with('category');

        $selectedYear = $request->input('year');
        
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

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $portfolios = $query
            ->with(['category.parent'])
            ->latest()
            ->paginate(self::PER_PAGE);

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

        return response()->json($portfolio, 201);
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
            'categories'
        ));
    }

    public function update(UpdatePortfolioRequest $request, $id)
    {
        $portfolio = $this->model::findOrFail($id);

        $validated = $request->validated();

        $portfolio->fill([
            'name' => $validated['name'],
            'location' => $validated['location'],
            'client' => $validated['client'] ?? null,
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'category_id' => $validated['category_id'],
            'year' => $validated['year'] ?? null,
            'content' => $request->input('content'),
        ]);

        if ($request->hasFile('image_new')) {
            if ($portfolio->image && Storage::exists('public/' . $portfolio->image)) {
                Storage::delete('public/' . $portfolio->image);
            }

            $portfolio->image = $request->file('image_new')
            ->store('portfolio', 'public');
        }
        
        $portfolio->save();

        $content = $request->input('content');
        preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches);
        $usedImageUrls = $matches[1] ?? [];

        $usedPaths = collect($usedImageUrls)->map(function ($url) {
            $relative = str_replace(asset('storage') . '/', '', $url);
            return trim($relative);
        })->toArray();

        $orphanImages = Media::whereNull('mediable_id')->where('type', 'image')->get();

        foreach ($orphanImages as $media) {
            if (!in_array($media->file_path, $usedPaths)) {
                if (Storage::disk('public')->exists($media->file_path)) {
                    Storage::disk('public')->delete($media->file_path);
                }
                $media->delete();
            }
        }
        
        return response()->json([
            'message' => 'Cập nhật thành công!',
            'data' => $portfolio,
        ], 200);
    }

    public function show(Portfolio $portfolio)
    {
        $portfolio->load('media');

        return view('admins.portfolios.show', compact(
            'portfolio'
        ));
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
