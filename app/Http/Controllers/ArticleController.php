<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Enums\CategoryType;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{   
    private Article $model;

    const PER_PAGE = 5;
    
    public function __construct()
    {
        $this->model = new Article();
    }

    public function index(Request $request)
    {   
        $search = $request->input('q');

        $query = $this->model::with('category');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $articles = $query
        ->with(['category.parent'])
        ->latest()
        ->paginate(self::PER_PAGE);

        $categories = Category::with('children')
            ->where('type', CategoryType::ARTICLE)
            ->whereNull('parent_id')
            ->get();

        return view('admins.articles.index', compact(
            'articles',
            'categories',
        ));
    }
    public function create()
    {
        $categories = Category::with('children')
            ->where('type', CategoryType::ARTICLE->value)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('admins.articles.create', compact('categories'));
    }

    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
            ->store('article', 'public');
        }
        
        $article = $this->model::create($validated);

        if (!empty($validated['category_ids'])) {
            $article->categories()->sync($validated['category_ids']);
        }

        return response()->json($article, 201);
    }

    public function edit($id)
    {
        $article = $this->model::findOrFail($id);

        $categories = Category::with('children')
            ->where('type', CategoryType::ARTICLE->value)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('admins.articles.edit', compact(
            'article',
            'categories'
        ));
    }

    public function update(UpdateArticleRequest $request, $id)
    {   
        $article = $this->model::findOrFail($id);

        $validated = $request->validated();

        $article->fill([
            'name' => $validated['name'],
            'link' => $validated['link'] ?? null,
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'type' => $validated['type']
        ]);

        if ($request->hasFile('image_new')) {
            if ($article->image && Storage::exists('public/' . $article->image)) {
                Storage::delete('public/' . $article->image);
            }
            $article->image = $request->file('image_new')->store('article', 'public');
        }

        $article->save();

        return response()->json([
            'message' => 'Cập nhật thành công!',
            'data' => $article,
        ], 200);

    }

    public function destroy(Article $article)
    {
        if ($article->image && Storage::exists('public/' . $article->image)) {
            Storage::delete('public/' . $article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Xoá bài viết thành công.');
    }
}
