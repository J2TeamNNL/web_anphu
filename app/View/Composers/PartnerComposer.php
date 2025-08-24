<?php

namespace App\View\Composers;

use App\Models\CustomPage;
use Illuminate\View\View;
use App\Models\Partner;
use Illuminate\Support\Facades\Schema;

class PartnerComposer
{
    public function compose(View $view)
    {
        $partners = Partner::get();
        
        $view->with('partners', $partners);
    }
}
