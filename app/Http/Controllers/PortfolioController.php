<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;

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
                    $q->orWhere('name', 'like', "%{$search}%");
                    $q->orWhere('location', 'like', "%{$search}%");
                    $q->orWhere('client', 'like', "%{$search}%");
                });
            })
            ->when($selectedYear, function ($query, $selectedYear) {
                $query->where('year', $selectedYear);
            })
            ->when($selectedCategoryId, function ($query, $selectedCategoryId) {
                $query->where('category_id', $selectedCategoryId);
            })
            ->orderByDesc('year')
            ->paginate(self::PER_PAGE)
            ->appends($request->query());

        $categories = Category::nestedTree();

        return view('admins.portfolios.index', [
            'portfolios' => $portfolios,
            'categories' => $categories,
            'search' => $search,
            'selectedYear' => $selectedYear,
            'selectedCategoryId' => $selectedCategoryId,
        ]);
    }

    public function create()
    {
        return view('admins.portfolios.create', [
            //
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'client' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:villa,town,commercial',
            'category' => 'required|string|max:50',
            'year' => 'nullable|integer|min:2000|max:' . date('Y'),

            'image' => 'nullable|image',
            'image1' => 'nullable|image',
            'image2' => 'nullable|image',
            'image3' => 'nullable|image',
            'image4' => 'nullable|image',
        ]);

        $portfolio = new Portfolio($validated);

        foreach (['image', 'image1', 'image2', 'image3', 'image4'] as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('portfolio', 'public');
                $portfolio->$field = $path;
            }
        }

        $portfolio->save();
        return response()->json($portfolio, 201);
    }

    public function edit(Portfolio $portfolio)
    {   
        return view('admins.portfolios.edit', [
            'portfolio' => $portfolio,
        ]);
    }

    public function update(Request $request, $id)
    {
        $portfolio = $this->model::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'client' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:villa,town,commercial',
            'category' => 'required|string|max:50',
            'year' => 'nullable|integer|min:2000|max:' . date('Y'),
            'image_new' => 'nullable|image',
        ]);

        $portfolio->fill([
            'name' => $validated['name'],
            'location' => $validated['location'],
            'client' => $validated['client'] ?? null,
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'category' => $validated['category'],
            'year' => $validated['year'] ?? null,
        ]);

        if ($request->hasFile('image_new')) {
            if ($portfolio->image && Storage::exists('public/' . $portfolio->image)) {
                Storage::delete('public/' . $portfolio->image);
            }

            $path = $request->file('image_new')->store('portfolio', 'public');
            $portfolio->image = $path;
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
