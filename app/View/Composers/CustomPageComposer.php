<?php

namespace App\View\Composers;

use App\Models\CustomPage;
use Illuminate\View\View;

class CustomPageComposer
{
    public function compose(View $view)
    {   
        $custom_pages = CustomPage::all();
        $view->with('custom_pages', $custom_pages);
    }
}
