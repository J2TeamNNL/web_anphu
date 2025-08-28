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
            // Nếu người dùng chọn 1 child cụ thể
            $selectedChild = $childCategories->firstWhere('slug', $selectedChildSlug);

            if ($selectedChild) {
                $query->where('category_id', $selectedChild->id);
            } else {
                // Nếu slug con không tồn tại → lấy tất cả child
                $query->whereIn('category_id', $childCategoryIds);
            }
        } else {
            if (!empty($childCategoryIds)) {
                // Nếu có child → lấy dự án thuộc các child
                $query->whereIn('category_id', $childCategoryIds);
            } else {
                // Nếu KHÔNG có child → lấy dự án thuộc chính cha
                $query->where('category_id', $parentCategory->id);
            }
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

        // Nếu là con → lấy cha làm activeCategory
        $activeCategory = $currentCategory->parent_id
            ? Category::findOrFail($currentCategory->parent_id)
            : $currentCategory;

        // Lấy danh sách con của cha (nếu có)
        $childCategories = Category::where('parent_id', $activeCategory->id)->get();

        // Query articles
        $articlesQuery = Article::query()->with('category');

        if ($currentCategory->parent_id) {
            // Nếu đang ở con → chỉ lấy bài trong con
            $articlesQuery->where('category_id', $currentCategory->id);
        } else {
            if ($childCategories->count()) {
                // Nếu là cha có con → filter theo request con
                $childId = $request->get('child_id');

                if ($childId) {
                    $articlesQuery->where('category_id', $childId);
                } else {
                    // chưa chọn con → mặc định lấy tất cả bài của các con
                    $articlesQuery->whereIn('category_id', $childCategories->pluck('id'));
                }
            } else {
                // cha không có con → lấy tất cả bài thuộc cha
                $articlesQuery->where('category_id', $currentCategory->id);
            }
        }

        $articles = $articlesQuery->latest()->paginate(9);

        $articleTitle = $currentCategory->name;

        return view('customers.pages.blogs', [
            'articles'         => $articles,
            'rootCategories'   => $rootCategories,
            'currentCategory'  => $currentCategory,
            'activeCategory'   => $activeCategory,
            'childCategories'  => $childCategories,
            'articleTitle'     => $articleTitle,
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