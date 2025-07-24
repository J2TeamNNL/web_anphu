<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


use Illuminate\Http\Request;

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
        $selectedCategoryId = $request->input('category_id');

        $portfolios = $this->model->query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('client', 'like', "%{$search}%");
                });
            })
            ->when($selectedYear, fn($query) => $query->where('year', $selectedYear))
            ->when($selectedCategoryId, fn($query) => $query->where('category_id', $selectedCategoryId))
            ->orderByDesc('year')
            ->paginate(self::PER_PAGE)
            ->appends($request->query());

        $categories = Category::with('children')
            ->where('type', CategoryType::PORTFOLIO)
            ->whereNull('parent_id')
            ->get();

        return view('admins.portfolios.index', compact(
            'portfolios',
            'categories',
            'search',
            'selectedYear',
            'selectedCategoryId'
        ));
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

        $portfolio = $this->model::create($validated);

        $portfolio->slug = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $portfolio->image = $request->file('image')
            ->store('portfolio', 'public');
        }

        $portfolio->save();

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
        ]);

        $portfolio->slug = Str::slug($validated['name']);

        if ($request->hasFile('image_new')) {
            if ($portfolio->image && Storage::exists('public/' . $portfolio->image)) {
                Storage::delete('public/' . $portfolio->image);
            }

            $portfolio->image = $request->file('image_new')
            ->store('portfolio', 'public');
        }

        $portfolio->save();

        return response()->json([
            'message' => 'Cập nhật thành công!',
            'data' => $portfolio,
        ], 200);
    }

    public function destroy(Portfolio $portfolio)
    {
        foreach (['image', 'image1', 'image2', 'image3', 'image4'] as $field) {
            if ($portfolio->$field && Storage::exists('public/' . $portfolio->$field)) {
                Storage::delete('public/' . $portfolio->$field);
            }
        }

        $portfolio->delete();

        return response()->json(['message' => 'Portfolio deleted']);
    }
}
