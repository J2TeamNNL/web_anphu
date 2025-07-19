<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{   
    private Article $model;

    private array $types;

    const PER_PAGE = 5;
    
    public function __construct()
    {
        $this->model = new Article();
        
        $this->types = Article::getTypes();
    }

    public function index(Request $request)
    {   
        $search = $request->input('q');
        $type = $request->input('type');

        $query = Article::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($type) {
            $query->where('type', $type);
        }

        $articles = $query->orderByDesc('type')->paginate(self::PER_PAGE)->appends($request->query());

        return view('admins.articles.index', [
            'articles' => $articles,
            'types' => $this->types,
            'search' => $search,
            'selectedType' => $type,
        ]);

    }

    public function create()
    {
        $types = $this->model->getTypes();

        return view('admins.articles.create',compact('types'));
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('article', 'public');
        }

        $article = Article::create($data);

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

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $validated = $request->validated();

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

            $article->image = $request->file('image_new')->store('article', 'public');
        }

        $article->save();

        return response()->json([
            'message' => 'Cập nhật thành công!',
            'data' => $article,
        ]);
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
