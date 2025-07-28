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
use Illuminate\Support\Facades\Log;

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

        $validated['content'] = $request->input('content');
        
        $article = $this->model::create($validated);

        if (!empty($validated['category_ids'])) {
            $article->categories()->sync($validated['category_ids']);
        }

        return response()->json($article, 201);
    }

    public function uploadImage(Request $request)
    {
        try {
            if (!$request->hasFile('upload')) {
                return response()->json(['error' => 'No file uploaded.'], 400);
            }

            $file = $request->file('upload');

            if (!$file->isValid()) {
                return response()->json(['error' => 'Invalid file.'], 400);
            }

            $path = $file->store('uploads/articles', 'public');

            $media = Media::create([
                'file_path' => $path,
                'type' => 'image',
            ]);

            return response()->json([
                'url' => asset('storage/' . $path),
                'uploaded' => 1,
                'fileName' => $file->getClientOriginalName(),
            ]);
        } catch (\Exception $e) {
            Log::error('Upload image failed: ' . $e->getMessage());
            return response()->json(['error' => 'Upload failed.'], 500);
        }
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
            $article->image = $request->file('image_new')->store('article', 'public');
        }

        $article->save();

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
            'data' => $article,
        ], 200);

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
