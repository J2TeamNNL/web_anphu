<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Enums\CategoryType;
use Illuminate\View\View;

class BlogCategoryComposer
{
    public function compose(View $view)
    {
        $blogsCategories = Category::whereNull('parent_id')
            ->where('type', CategoryType::ARTICLE->value)
            ->with('children')
            ->get();

        $view->with('blogsCategories', $blogsCategories);
    }
}
