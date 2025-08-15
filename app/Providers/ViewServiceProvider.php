<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\Category;
use App\Models\CompanySetting;
use App\Models\Service;
use App\Models\CustomPage;

use App\Enums\CategoryType;
use Illuminate\Support\Facades\Log;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {   

        try {
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

            $partners = collect();

            if (Schema::hasTable('partners')) {
                $partners = Partner::get();
            }

            $companySettings = CompanySetting::first();

            $services = collect();

            if (class_exists(Service::class) && Schema::hasTable('services')) {
                $services = Service::all();
            }

            $custom_pages = CustomPage::all();

            View::share([
                'interiorProjects' => $interiorProjects,
                'otherProjects' => $otherProjects,
                'partners' => $partners,
                'companySettings' => $companySettings,
                'services' => $services,
                'custom_pages' => $custom_pages
            ]);

        } catch (\Throwable $e) {
            Log::error('ViewServiceProvider Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    
        
    }
    
    public function register(): void
    {
        //
    }
}
