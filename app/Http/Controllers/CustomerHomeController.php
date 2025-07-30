<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Partner;
use App\Models\Category;
use App\Enums\CategoryType;


class CustomerHomeController extends Controller
{
    // public function index()
    // {
    //     $interiorCategory = Category::where('slug', 'noi-that')
    //         ->where('type', CategoryType::PORTFOLIO->value)
    //         ->first();

    //     $interiorCategoryIds = collect();
    //     if ($interiorCategory) {
    //         $interiorCategoryIds->push($interiorCategory->id);
    //         $interiorCategoryIds = $interiorCategoryIds->merge(
    //             $interiorCategory->children->pluck('id')
    //         );
    //     }

    //     $interiorProjects = Portfolio::with('category')
    //         ->whereIn('category_id', $interiorCategoryIds)
    //         ->latest()
    //         ->take(4)
    //         ->get();

    //     $otherProjects = Portfolio::with('category')
    //         ->whereNotIn('category_id', $interiorCategoryIds)
    //         ->latest()
    //         ->take(4)
    //         ->get();

    //     $partners = Partner::all();

    //     return view('customers.pages.index', [
    //         'interiorProjects' => $interiorProjects,
    //         'otherProjects' => $otherProjects,
    //         'partners' => $partners,
    //     ]);
    // }

    public function index()
    {
        return view('customers.pages.index');
    }
}
