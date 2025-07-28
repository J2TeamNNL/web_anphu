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

        $validated['content'] = $request->input('content');
        
        $article = $this->model::create($validated);

        if (!empty($validated['category_ids'])) {
            $article->categories()->sync($validated['category_ids']);
        }

        $content = $validated['content'] ?? '';
        preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches);
        $usedImageUrls = $matches[1] ?? [];

        $usedPaths = collect($usedImageUrls)->map(function ($url) {
            return str_replace(asset('storage') . '/', '', $url);
        })->toArray();

        $usedPaths = collect($usedImageUrls)->map(function ($url) {
            $relative = str_replace(asset('storage') . '/', '', $url);
            return trim($relative);
        })->toArray();

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
            'type' => $validated['type'],
            'content' => $request->input('content'),
        ]);

        if ($request->hasFile('image_new')) {
            if ($article->image && Storage::exists('public/' . $article->image)) {
                Storage::delete('public/' . $article->image);
            }
            $article->image = $request->file('image_new')
            ->store('article', 'public');
        }

        $article->save();

        // Gắn lại media trong content
        $content = $request->input('content');
        preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches);
        $usedImageUrls = $matches[1] ?? [];

        $usedPaths = collect($usedImageUrls)->map(function ($url) {
            return str_replace(asset('storage') . '/', '', $url);
        })->toArray();

        // Cập nhật mediable cho ảnh dùng trong content
        Media::whereNull('mediable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPaths)
            ->update([
                'mediable_id' => $article->id,
                'mediable_type' => Article::class,
            ]);

        // Chỉ xoá ảnh chưa có mediable và không dùng nữa trong content này
        Media::whereNull('mediable_id')
            ->where('type', 'image')
            ->whereNotIn('file_path', $usedPaths)
            ->each(function ($media) {
                if (Storage::disk('public')->exists($media->file_path)) {
                    Storage::disk('public')->delete($media->file_path);
                }
                $media->delete();
            });
        
        return redirect()->route('admin.articles.index');
        // return response()->json([
        //     'message' => 'Cập nhật thành công!',
        //     'data' => $article,
        // ], 200);

    }

    public function show(Article $article)
    {
        $article->load('media');

        return view('admins.articles.show', compact(
            'article'
        ));
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
