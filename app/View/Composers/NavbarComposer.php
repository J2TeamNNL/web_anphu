<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Service;
use App\Models\CustomPage;
use App\Models\Category;
use App\Enums\CategoryType;

class NavbarComposer
{
    public function compose(View $view)
    {

        $portfoliosCategories = Category::query()
            ->where('type', CategoryType::PORTFOLIO->value)
            ->whereNull('parent_id')
            ->with('children')
            ->get();

        $blogsCategories = Category::query()
            ->where('type', CategoryType::ARTICLE->value)
            ->whereNull('parent_id')
            ->with('children')
            ->get();

        $view->with(compact('portfoliosCategories', 'blogsCategories'));
    }
}