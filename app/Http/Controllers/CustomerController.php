<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Models\Portfolio;
use App\Models\Article;
use App\Models\Service;
use App\Models\Category;
use App\Models\CustomPage;
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
        $page = CustomPage::where('slug', 'index')->first();

        return view('customers.pages.index', compact('page'));
    }

    public function contact()
    {   
        $page = CustomPage::where('slug', 'lien-he')->firstOrFail();

        return view('customers.pages.lien_he',[
            'page' => $page
        ]);
    }
    

    //CUSTOM PAGES
    public function showCustomPage($slug)
    {
        $page = CustomPage::where('slug', $slug)->firstOrFail();

        // 1 slug load view riêng
        $viewPath = 'customers.pages.' . str_replace('-', '_', $slug);
        if (view()->exists($viewPath)) {
            return view($viewPath, compact('page'));
        }

        // 1 view chung để hiển thị toàn bộ custom_pages
        return view('customers.pages.index', compact('page'));
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


    // POLICY
    public function policyDetail()
    {
        $policyContent = CompanySetting::value('policy_content') ?? '';

        return view('customers.pages.policy', [
            'policyContent' => $policyContent,
        ]);
    }

    public function voucher(){

        $page = CustomPage::where('slug', 'uu-dai')->firstOrFail();

        return view('customers.pages.uu_dai', compact('page'));
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

}
