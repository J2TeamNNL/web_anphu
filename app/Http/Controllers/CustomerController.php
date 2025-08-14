<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Models\Portfolio;
use App\Models\Article;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CompanySetting;

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

    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        return view('customers.pages.service_detail', compact('service'));
    }

    public function servicePrice($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        return view('customers.pages.service_price', compact('service'));
    }

    public function policyDetail()
    {
        $policyContent = CompanySetting::value('policy_content') ?? '';

        return view('customers.pages.policy', [
            'policyContent' => $policyContent,
        ]);
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
        // Lấy tất cả danh mục cha cấp 1 (loại ARTICLE)
        $rootCategories = Category::where('type', CategoryType::ARTICLE->value)
            ->whereNull('parent_id')
            ->get();

        // Tìm category hiện tại (cha hoặc con)
        $currentCategory = Category::where('slug', $slug)
            ->where('type', CategoryType::ARTICLE->value)
            ->firstOrFail();

        // Nếu là con → lấy cha làm danh mục active filter
        if ($currentCategory->parent_id) {
            $activeCategory = Category::findOrFail($currentCategory->parent_id);
        } else {
            $activeCategory = $currentCategory;
        }

        // Query bài viết theo danh mục hiện tại
        $articles = Article::query()
            ->with('category')
            ->where('category_id', $currentCategory->id)
            ->latest()
            ->paginate(9);

        // Tiêu đề
        $articleTitle = 'Bài đăng - ' . $currentCategory->name;

        return view('customers.pages.blogs', [
            'articles'        => $articles,
            'rootCategories'  => $rootCategories,   // tất cả danh mục cha
            'currentCategory' => $currentCategory,  // đang xem
            'activeCategory'  => $activeCategory,   // cha để active filter
            'articleTitle'    => $articleTitle,
        ]);
    }

    public function blogDetail(string $slug)
    {
        // Lấy bài viết kèm category
        $article = Article::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        // SEO Title
        $articleTitle = $article->name;

        return view('customers.pages.blog_detail', [
            'article' => $article,
            'articleTitle' => $articleTitle,
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
