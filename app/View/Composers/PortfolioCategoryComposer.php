<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\Portfolio;
use App\Enums\CategoryType;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class PortfolioCategoryComposer
{
    public function compose(View $view): void
    {
        $portfolioByCategories = Cache::remember('portfolio_by_categories', now()->addMinutes(30), function () {
            // Lấy categories gốc kèm children
            $categories = Category::whereNull('parent_id')
                ->where('type', CategoryType::PORTFOLIO->value)
                ->with('children')
                ->get();

            // Lấy toàn bộ portfolio thuộc các category này (cha + con)
            $categoryIds = $categories->flatMap(function ($cat) {
                return collect([$cat->id])->merge($cat->children->pluck('id'));
            });

            $portfolios = Portfolio::with('category')
                ->whereIn('category_id', $categoryIds)
                ->latest()
                ->get();

            // Nhóm portfolios theo category cha
            $result = [];
            foreach ($categories as $category) {
                $ids = collect([$category->id])->merge($category->children->pluck('id'));

                $projects = $portfolios->whereIn('category_id', $ids)
                    ->take(4); // giới hạn 4 như code gốc

                $result[] = [
                    'category' => $category,
                    'projects' => $projects,
                ];
            }

            return $result;
        });

        $view->with('portfolioByCategories', $portfolioByCategories);
    }
}