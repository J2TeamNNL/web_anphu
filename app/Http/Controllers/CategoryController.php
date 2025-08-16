<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{   

    public function index(Request $request)
    {
        $type = $request->query('type');

        $categories = Category::query()
            ->whereNull('parent_id')
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->with('children')
            ->orderByDesc('id')
            ->paginate(5)
            ->appends($request->query());

        return view('admins.categories.index', compact(
            'categories',
            'type'
        ));
    }

    public function create()
    {   
        return view('admins.categories.create', [
            'category' => new Category(),
            'types' => CategoryType::cases(),
            'parentCategories' => Category::all(),
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'type' => $request->type,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.categories.index')
        ->with('success', 'Tạo danh mục thành công');
    }

    public function edit(Category $category)
    {   
        $parentCategories = Category::whereNull('parent_id')
        ->where('type', $category->type)
        ->where('id', '!=', $category->id)
        ->get();

        return view('admins.categories.edit', [
            'category' => $category,
            'types' => CategoryType::cases(),
            'parentCategories' => $parentCategories,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'type' => $request->type,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.categories.index')
        ->with('success', 'Cập nhật danh mục thành công');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Xóa danh mục thành công');
    }
}
