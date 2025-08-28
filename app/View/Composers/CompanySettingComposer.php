<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;
use App\Models\CompanySetting;

class CompanySettingComposer
{
    public function compose(View $view)
    {
        $companySettings = CompanySetting::first();

        $view->with('companySettings', $companySettings);
    }
}