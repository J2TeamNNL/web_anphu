<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\Category;
use App\Models\CompanySetting;

use App\Enums\CategoryType;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {   
    
        $interiorCategory = Category::with('children')
            ->where('slug', 'noi-that')
            ->where('type', CategoryType::PORTFOLIO->value)
            ->first();

        $interiorCategoryIds = collect();

        if ($interiorCategory) {
            $interiorCategoryIds = collect([$interiorCategory->id])
                ->merge($interiorCategory->children->pluck('id'));
        }

        $interiorProjects = collect();
        $otherProjects = collect();

        if ($interiorCategoryIds->isNotEmpty()) {
            $interiorProjects = Portfolio::with('category')
                ->whereIn('category_id', $interiorCategoryIds)
                ->latest()
                ->take(4)
                ->get();

            $otherProjects = Portfolio::with('category')
                ->whereNotIn('category_id', $interiorCategoryIds)
                ->latest()
                ->take(4)
                ->get();
        }

        $partners = Partner::query()->get();

        $companySettings = CompanySetting::first();

        View::share([
            'interiorProjects' => $interiorProjects,
            'otherProjects' => $otherProjects,
            'partners' => $partners,
            'companySettings' => $companySettings,
        ]);
    }
    
    public function register(): void
    {
        //
    }
}
