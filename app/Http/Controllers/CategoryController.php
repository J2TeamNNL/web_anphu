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
        $modelType = $request->get('model', 'portfolio');
        
        if (!in_array($modelType, ['portfolio', 'article'])) {
            abort(404);
        }

        $categories = Category::nestedTree([$modelType]);

        return view('admins.categories.index', compact(
            'categories', 
            'type'
        ));
    }

    public function create(Request $request)
    {
        $type = $request->get('type', 'portfolio');

        $parents = Category::where('type', $type)
        ->whereNull('parent_id')->get();

        return view('admins.categories.create', compact(
            'parents',
            'type'
        ));
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        
        $data['slug'] = Str::slug($data['name']);

        $data['type'] = $request->get('type', 'portfolio');

        Category::create($data);

        return redirect()->route('admins.categories.index',[
            'type' => $data['type']]
        )->with('success', 'Tạo danh mục thành công');
    }

    public function edit(Request $request)
    {
        $modelType = $request->get('model', 'portfolio');
        
        if (!in_array($modelType, ['portfolio', 'article'])) {
            abort(404);
        }

        $categories = Category::nestedTree([$modelType]);

        return view('admin.categories.edit', [
            'categories' => $categories,
            'modelType' => $modelType,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        $category->update($data);

        return redirect()->route('admins.categories.index')->with('success', 'Cập nhật danh mục thành công');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admins.categories.index')->with('success', 'Xoá danh mục thành công');
    }
}
