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

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {   
        View::composer([
            'customers.partials.nav_bar',
        ], NavbarComposer::class);

        View::composer([
            'customers.partials.nav_bar',
        ], ServiceComposer::class);

        View::composer([
            'customers.partials.nav_bar',
        ], CustomPageComposer::class);

        View::composer(
            ['customers.partials.anphu.partner'],
            PartnerComposer::class
        );

        View::composer([
            'customers.partials.anphu.solution',
        ], ServiceComposer::class);

        View::composer([
            'customers.partials.anphu.demo_projects',

        ], PortfolioCategoryComposer::class);

        View::composer([
            'customers.pages.project_detail',
            'customers.pages.service_detail',
            'customers.pages.service_price',
            'customers.pages.uu_dai',
            'customers.pages.lien_he',
            'customers.pages.blog_detail',
        ], ExtraContentComposer::class);

        View::composer('*', CompanySettingComposer::class);

    }
    
    public function register(): void
    {
        //
    }
}
