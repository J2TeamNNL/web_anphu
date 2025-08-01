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

use App\Models\Media;
use App\Helpers\ImageHelper;

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

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $articles = $query
            ->with(['category.parent'])
            ->latest()
            ->paginate(self::PER_PAGE);

        $categories = Category::with('children')
            ->where('type', CategoryType::ARTICLE)
            ->whereNull('parent_id')
            ->get();

        return view('admins.articles.index', compact('articles', 'categories'));
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
            $validated['image'] = $request->file('image')->store('article', 'public');
        }

        // Xử lý ảnh trong content
        $result = ImageHelper::extractAndUploadBase64Images($request->input('content') ?? '');
        $validated['content'] = $result['content'];
        $usedPaths = $result['paths'];

        $article = $this->model::create($validated);

        if (!empty($validated['category_ids'])) {
            $article->categories()->sync($validated['category_ids']);
        }

        // Gắn lại media mới cho article
        Media::whereNull('mediable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPaths)
            ->update([
                'mediable_id' => $article->id,
                'mediable_type' => Article::class,
            ]);

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

        return view('admins.articles.edit', compact('article', 'categories'));
    }

    public function update(UpdateArticleRequest $request, $id)
    {
        $article = $this->model::findOrFail($id);

        $validated = $request->validated();

        // Xử lý ảnh trong content trước khi fill
        $result = ImageHelper::extractAndUploadBase64Images($request->input('content') ?? '');
        $validated['content'] = $result['content'];
        $usedPaths = $result['paths'];

        $article->fill([
            'name' => $validated['name'],
            'link' => $validated['link'] ?? null,
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'type' => $validated['type'],
            'content' => $validated['content'],
        ]);

        if ($request->hasFile('image_new')) {
            if ($article->image && Storage::exists('public/' . $article->image)) {
                Storage::delete('public/' . $article->image);
            }
            $article->image = $request->file('image_new')->store('article', 'public');
        }

        $article->save();

        // Xoá media cũ không còn được dùng trong content
        Media::where('mediable_id', $article->id)
            ->where('mediable_type', Article::class)
            ->where('type', 'image')
            ->whereNotIn('file_path', $usedPaths)
            ->each(function ($media) {
                if (Storage::disk('public')->exists($media->file_path)) {
                    Storage::disk('public')->delete($media->file_path);
                }
                $media->delete();
            });

        // Gắn lại media mới
        Media::whereNull('mediable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPaths)
            ->update([
                'mediable_id' => $article->id,
                'mediable_type' => Article::class,
            ]);

        return redirect()->route('admin.articles.index');
    }

    public function show(Article $article)
    {
        $article->load('media');

        return view('admins.articles.show', compact('article'));
    }

    public function destroy(Article $article)
    {
        if ($article->image && Storage::exists('public/' . $article->image)) {
            Storage::delete('public/' . $article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Xoá bài viết thành công.');
    }
}