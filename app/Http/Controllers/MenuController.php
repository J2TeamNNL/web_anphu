<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Enums\CategoryType;
use App\Models\Portfolio;
use Illuminate\Support\Facades\View;

class MenuController extends Controller
{

    public static function portfolioNavbarData()
    {
        return [
            'portfoliosCategories' => Category::where('type', CategoryType::PORTFOLIO)
                ->whereNull('parent_id')
                ->with('children') 
                ->get(),
            'selectedCategory' => null,
        ];
    }

    public static function articleNavbarData()
    {
        return [
            'blogsCategories' => Category::where('type', CategoryType::ARTICLE)
                ->whereNull('parent_id')
                ->with('children') 
                ->get(),
            'selectedCategory' => null,
        ];
    }
}