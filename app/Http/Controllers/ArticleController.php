<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ArticleController extends Controller
{   
    private Article $model;

    public function __construct()
    {
        $this->model = new Article();
    }

    public function index(Request $request)
    {   
        $query = Article::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $types = $this->model->getTypes();

        $articles = $this->model->latest()->get();

        return view('admins.articles.index', compact('articles','types'));
    }

    public function create()
    {
        $types = $this->model->getTypes();

        return view('admins.articles.create',compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
            'type' => 'required|in:construction,daily,event',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('article', 'public');
            $validated['image'] = $imagePath;
        }

        $article = new Article($validated);

        $article->save();

        return response()->json($article, 201);
    }

    public function edit(Article $article)
    {      

        $types = $this->model->getTypes();

        return view('admins.articles.edit', [
            'article' => $article,
            'types' => $types,
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'image_new' => 'nullable|image',
            'description' => 'nullable|string',
            'type' => 'required|in:construction,daily,event',
        ]);

        $article->fill([
            'name' => $validated['name'],
            'link' => $validated['link'] ?? null,
            'description' => $validated['description'] ?? null,
            'type' => $validated['type']
            
        ]);

        if ($request->hasFile('image_new')) {
            if ($article->image && Storage::exists('public/' . $article->image)) {
                Storage::delete('public/' . $article->image);
            }

            $path = $request->file('image_new')->store('article', 'public');
            $article->image = $path;
        }

        $article->save();
        
        return response()->json([
            'message' => 'Cập nhật thành công!',
            'data' => $article,
        ], 200);
    }

    public function destroy($id)
    {
        $portfolio = Article::findOrFail($id);

        foreach (['image', 'image1', 'image2', 'image3', 'image4'] as $field) {
            if ($portfolio->$field && Storage::exists('public/' . $portfolio->$field)) {
                Storage::delete('public/' . $portfolio->$field);
            }
        }

        $portfolio->delete();

        return response()->json(['message' => 'Portfolio deleted']);
    }
}
