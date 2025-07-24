<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Enums\CategoryType;
use App\Models\Category;
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
    }

    public function index(Request $request)
    {   
        $search = $request->input('q');

        $query = Article::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $articles = $query->latest()->paginate(self::PER_PAGE);

        return view('admins.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::nestedTree(CategoryType::ARTICLE);
        $types = Category::where('type', CategoryType::ARTICLE_TYPE)->get();

        return view('admins.articles.create', compact('categories', 'types'));
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('article', 'public');
        }

        $article = Article::create($data);

        $article->categories()->sync(array_merge(
            $request->input('category_ids', []),
            $request->input('type_ids', [])
        ));

        return redirect()->route('articles.index')->with('success', 'Tạo bài viết thành công');
    }

    public function edit(Article $article)
    {
        $categories = Category::nestedTree(CategoryType::ARTICLE);
        $types = Category::where('type', CategoryType::ARTICLE_TYPE)->get();

        $selectedCategories = $article->articleCategories->pluck('id')->toArray();
        $selectedTypes = $article->articleTypes->pluck('id')->toArray();

        return view('admins.articles.edit', compact('article', 'categories', 'types', 'selectedCategories', 'selectedTypes'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->validated();

        if ($request->hasFile('image_new')) {
            if ($article->image && Storage::exists('public/' . $article->image)) {
                Storage::delete('public/' . $article->image);
            }
            $data['image'] = $request->file('image_new')->store('article', 'public');
        }

        $article->update($data);

        $article->categories()->sync(array_merge(
            $request->input('category_ids', []),
            $request->input('type_ids', [])
        ));

        return redirect()->route('articles.index')->with('success', 'Cập nhật bài viết thành công');
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
