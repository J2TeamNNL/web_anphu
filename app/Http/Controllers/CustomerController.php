<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Models\Customer;
use App\Models\Portfolio;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;


class CustomerController extends Controller
{       
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $portfolios = Portfolio::query()
            ->limit(4)
            ->get();

        return view('customers.pages.index', [
            'portfolios' => $portfolios
        ]);
    }
    
    public function consultant()
    {
        return view('customers.pages.consultant');
    }

    public function blog()
    {
        return view('customers.pages.blog');
    }

    public function contact()
    {
        return view('customers.pages.contact');
    }
    
    // ABOUT
    public function aboutAnphu()
    {   
        return view('customers.pages.about_anphu');
    }

    public function aboutOpenLetter()
    {
        return view('customers.pages.about_open_letter');
    }

    public function aboutCulturalValues()
    {
        return view('customers.pages.about_cultural_values');
    }


    // SERVICES

    public function servicesContructionFull()
    {
        return view('customers.pages.services_construction_full');
    }

    public function servicesDesignArchitect()
    {
        return view('customers.pages.services_design_architect');
    }

    public function servicesDesignInterior()
    {
        return view('customers.pages.services_design_interior');
    }

    public function servicesContructionRenovate()
    {
        return view('customers.pages.services_construction_renovate');
    }

    // PORTFOLIOS

    public function projectByCategory(Request $request, string $slug)
    {
        $parentCategory = Category::where('slug', $slug)
            ->where('type', CategoryType::PORTFOLIO->value)
            ->whereNull('parent_id')
            ->with('children')
            ->firstOrFail();

        $childCategories = $parentCategory->children;

        $childCategoryIds = $childCategories->pluck('id')->toArray();

        $selectedChildSlug = $request->query('child');
        $selectedChild = null;

        $query = Portfolio::query()->with('category');

        if ($selectedChildSlug) {
            $selectedChild = $childCategories->firstWhere('slug', $selectedChildSlug);

            if ($selectedChild) {
                $query->where('category_id', $selectedChild->id);
            } else {
                $query->whereIn('category_id', $childCategoryIds);
            }
        } else {
            $query->whereIn('category_id', $childCategoryIds);
        }

        $portfolios = $query->latest()->paginate(9);

        $projectTitle = $selectedChild
        ? 'Dự án - ' . $selectedChild->name
        : 'Dự án - ' . $parentCategory->name;

        return view('customers.pages.projects', [
            'portfolios' => $portfolios,
            'parentCategory' => $parentCategory,
            'childCategories' => $childCategories,
            'selectedChild' => $selectedChild,
            'projectTitle' => $projectTitle,
        ]);
    }

    public function projectDetail($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->firstOrFail();

        return view('customers.pages.project_detail', [
            'portfolio' => $portfolio
        ]);
    }

    // BLOGS

    public function blogIndex(Request $request, string $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('type', CategoryType::ARTICLE->value)
            ->whereNull('parent_id')
            ->firstOrFail();

        $articles = Article::query()
            ->where('category_id', $category->id)
            ->with('category')
            ->latest()
            ->paginate(9);

        $articleTitle = 'Hoạt động - ' . $category->name;

        return view('customers.pages.blogs', [
            'articles' => $articles,
            'parentCategory' => $category,
            'childCategories' => collect(),
            'selectedChild' => null,
            'articleTitle' => $articleTitle,
        ]);
    }

    public function blogDetail($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        return view('customers.pages.blog_detail', [
            'article' => $article
        ]);
    }

    //PRICE
    public function priceFull()
    {
        return view('customers.pages.price_full');
    }
    public function priceRaw()
    {
        return view('customers.pages.price_raw');
    }
    public function priceDesign()
    {
        return view('customers.pages.price_design');
    }
    public function pricePermit()
    {
        return view('customers.pages.price_permit');
    }

}
