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
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use App\Services\CloudinaryService;

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
            $category = Category::find($request->category_id);
            if ($category) {
                $categoryIds = collect([$category->id])
                    ->merge($category->childrenRecursive()->pluck('id'))
                    ->flatten()
                    ->toArray();

                $query->whereIn('category_id', $categoryIds);
            }
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

    public function store(StoreArticleRequest $request, CloudinaryService $cloudinaryService)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('thumbnail')) {
            $uploadResult = $cloudinaryService->upload($request
                ->file('thumbnail'), 'articles');

            $validated['thumbnail'] = $uploadResult['url'];
        }

        $article = $this->model::create($validated);

        if (!empty($validated['category_ids'])) {
            $article->categories()->sync($validated['category_ids']);
        }

        $result = ImageHelper::extractAndUploadBase64Images($validated['content'] ?? '');
        $validated['content'] = $result['content'];
        $usedPaths = $result['paths'];

        Media::whereNull('mediaable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPaths)
            ->update([
                'mediaable_id' => $article->id,
                'mediaable_type' => Article::class,
            ]);

        return redirect()->route('admin.articles.index');
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
            'article', 'categories'
        ));
    }

    public function update(UpdateArticleRequest $request, Article $article, CloudinaryService $cloudinaryService)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail_public_id) {
                $cloudinaryService->delete($article->thumbnail_public_id);
            }

            $uploadResult = $cloudinaryService->upload($request->file('thumbnail'), 'articles');

            $data['thumbnail'] = $uploadResult['url'] ?? null; // Đảm bảo đúng key như store()
            $data['thumbnail_public_id'] = $uploadResult['public_id'] ?? null;
        } else {
            // Rất quan trọng: giữ nguyên ảnh cũ nếu không upload ảnh mới
            $data['thumbnail'] = $article->thumbnail;
            $data['thumbnail_public_id'] = $article->thumbnail_public_id;
        }

        $result = ImageHelper::extractAndUploadBase64Images($data['content'] ?? '');
        $data['content'] = $result['content'];
        $usedPaths = $result['paths'];

        Media::whereNull('mediaable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $usedPaths)
            ->update([
                'mediaable_id' => $article->id,
                'mediaable_type' => Article::class,
            ]);

        $article->update($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Cập nhật thành công!');
    }

    public function show(Article $article)
    {
        $article->load('media');

        return view('admins.articles.show', compact('article'));
    }

    public function destroy(Article $article)
    {
        if ($article->thumbnail_public_id) {
            Cloudinary::destroy($article->thumbnail_public_id);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
        ->with('success', 'Xoá bài viết thành công.');
    }
}