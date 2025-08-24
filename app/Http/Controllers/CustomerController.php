<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    protected $customers;

    public function __construct(CustomerRepository $customers)
    {
        $this->customers = $customers;
    }

    // ===== PAGES =====
    public function index()
    {
        $page = $this->customers->getPage('index');
        return view('customers.pages.index', compact('page'));
    }

    public function contact()
    {
        $page = $this->customers->getPage('lien-he');
        return view('customers.pages.lien_he', compact('page'));
    }

    public function voucher()
    {
        $page = $this->customers->getPage('uu-dai');
        return view('customers.pages.uu_dai', compact('page'));
    }

    public function showCustomPage($slug)
    {
        $page = $this->customers->getPage($slug);

        $viewPath = 'customers.pages.' . str_replace('-', '_', $slug);
        if (view()->exists($viewPath)) {
            return view($viewPath, compact('page'));
        }
        return view('customers.pages.index', compact('page'));
    }

    // ===== SERVICES =====
    public function serviceDetail($slug)
    {
        $service = $this->customers->getService($slug);
        return view('customers.pages.service_detail', compact('service'));
    }

    public function servicePrice($slug)
    {
        $service = $this->customers->getService($slug);
        return view('customers.pages.service_price', compact('service'));
    }

    // ===== POLICY =====
    public function policyDetail()
    {
        // policy đã có trong CompanySettingComposer
        return view('customers.pages.policy');
    }

    // ===== PORTFOLIOS =====
    public function projectByCategory(Request $request, string $slug)
    {
        $parentCategory = $this->customers->getPortfolioParentCategory($slug);
        $childCategories = $parentCategory->children;
        $childCategoryIds = $childCategories->pluck('id')->toArray();

        $selectedChildSlug = $request->query('child');
        $selectedChild = $childCategories->firstWhere('slug', $selectedChildSlug);

        $query = Portfolio::query()->with('category');
        if ($selectedChild) {
            $query->where('category_id', $selectedChild->id);
        } else {
            $query->whereIn('category_id', $childCategoryIds ?: [$parentCategory->id]);
        }

        $portfolios = $query->latest()->paginate(9);
        $projectTitle = 'Dự án - ' . ($selectedChild->name ?? $parentCategory->name);

        return view('customers.pages.projects', compact(
            'portfolios', 'parentCategory', 'childCategories', 'selectedChild', 'projectTitle'
        ));
    }

    public function projectDetail($slug)
    {
        $portfolio = $this->customers->getPortfolio($slug);
        return view('customers.pages.project_detail', compact('portfolio'));
    }

    // ===== BLOGS =====
    public function blogIndex(Request $request, string $slug)
    {
        $rootCategories = $this->customers->getRootArticleCategories();
        $currentCategory = $this->customers->getArticleCategory($slug);

        $activeCategory = $currentCategory->parent_id
            ? $this->customers->getArticleCategory($currentCategory->parent_id)
            : $currentCategory;

        $childCategories = $this->customers->getChildCategories($activeCategory->id);

        $articlesQuery = Article::query()->with('category');

        if ($currentCategory->parent_id) {
            $articlesQuery->where('category_id', $currentCategory->id);

        } elseif ($childCategories->count()) {
            $childId = $request->get('child_id');

            if ($childId) {
                $articlesQuery->where('category_id', $childId);
            } else {
                $articlesQuery->whereIn('category_id', $childCategories->pluck('id'));
            }

        } else {
            $articlesQuery->where('category_id', $currentCategory->id);
        }

        $articles = $articlesQuery->latest()->paginate(9);
        $articleTitle = $currentCategory->name;

        return view('customers.pages.blogs', compact(
            'articles', 'rootCategories', 'currentCategory', 'activeCategory', 'childCategories', 'articleTitle'
        ));
    }

    public function blogDetail(string $slug)
    {
        $article = $this->customers->getArticle($slug);
        $articleTitle = $article->name;

        return view('customers.pages.blog_detail', compact('article', 'articleTitle'));
    }
}
