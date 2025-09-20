<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\View\Composers\ServiceComposer;
use App\View\Composers\PortfolioCategoryComposer;
use App\View\Composers\CompanySettingComposer;

use App\View\Composers\ExtraContentComposer;
use App\View\Composers\PartnerComposer;

use App\View\Composers\NavbarComposer;
use App\View\Composers\CustomPageComposer;

class ViewServiceProvider_wip extends ServiceProvider
{
    public function boot()
    {   
        $view = $this->app->make('view');

    $view->composer(['customers.partials.nav_bar'], NavbarComposer::class);
    $view->composer(['customers.partials.nav_bar'], ServiceComposer::class);
    $view->composer(['customers.partials.nav_bar'], CustomPageComposer::class);

    $view->composer(['customers.partials.anphu.partner'], PartnerComposer::class);
    $view->composer(['customers.partials.anphu.solution'], ServiceComposer::class);
    $view->composer(['customers.partials.anphu.demo_projects'], PortfolioCategoryComposer::class);

    $view->composer([
        'customers.pages.project_detail',
        'customers.pages.service_detail',
        'customers.pages.service_price',
        'customers.pages.lien_he',
        'customers.pages.blog_detail',
    ], ExtraContentComposer::class);

    $view->composer('*', CompanySettingComposer::class);

    }
    
    public function register(): void
    {
        //
    }
}
