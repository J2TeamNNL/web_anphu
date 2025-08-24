<?php

namespace App\Repositories;

use App\Models\CustomPage;
use App\Models\Category;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Article;
use App\Enums\CategoryType;
use Illuminate\Support\Facades\Cache;

class CustomerRepository
{
    // ===== CUSTOM PAGES =====
    public function getPage(string $slug)
    {
        return Cache::remember("page_{$slug}", 600, fn() =>
            CustomPage::where('slug', $slug)->firstOrFail()
        );
    }

    // ===== SERVICES =====
    public function getService(string $slug)
    {
        return Cache::remember("service_{$slug}", 600, fn() =>
            Service::where('slug', $slug)->firstOrFail()
        );
    }

    // ===== PORTFOLIOS =====
    public function getPortfolio(string $slug)
    {
        return Cache::remember("portfolio_{$slug}", 600, fn() =>
            Portfolio::where('slug', $slug)->firstOrFail()
        );
    }

    public function getPortfolioParentCategory(string $slug)
    {
        return Cache::remember("portfolio_category_{$slug}", 600, fn() =>
            Category::where('slug', $slug)
                ->where('type', CategoryType::PORTFOLIO->value)
                ->whereNull('parent_id')
                ->with('children')
                ->firstOrFail()
        );
    }

    // ===== BLOGS =====
    public function getArticleCategory(string $slug)
    {
        return Cache::remember("article_category_{$slug}", 600, fn() =>
            Category::where('slug', $slug)
                ->where('type', CategoryType::ARTICLE->value)
                ->firstOrFail()
        );
    }

    public function getRootArticleCategories()
    {
        return Cache::remember('root_article_categories', 600, fn() =>
            Category::where('type', CategoryType::ARTICLE->value)
                ->whereNull('parent_id')
                ->get()
        );
    }

    public function getChildCategories(int $parentId)
    {
        return Cache::remember("child_categories_{$parentId}", 600, fn() =>
            Category::where('parent_id', $parentId)->get()
        );
    }

    public function getArticle(string $slug)
    {
        return Cache::remember("article_{$slug}", 600, fn() =>
            Article::with('category')->where('slug', $slug)->firstOrFail()
        );
    }
}
