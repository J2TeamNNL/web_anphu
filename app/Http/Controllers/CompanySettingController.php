<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanySettingRequest;
use Illuminate\Http\Request;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Storage;

class CompanySettingController extends Controller
{

    public function edit()
    {
        $setting = CompanySetting::first();
        return view('admins.settings.company.edit', compact('setting'));
    }

    public function update(UpdateCompanySettingRequest $request)
    {
        $request->validated();

        $setting = CompanySetting::first();

        if ($request->hasFile('company_logo')) {
            if ($setting->company_logo && Storage::disk('public')->exists($setting->company_logo)) {
                Storage::disk('public')->delete($setting->company_logo);
            }

            $path = $request->file('company_logo')->store('logos', 'public');
            $setting->company_logo = $path;
        }

        $setting->company_name = $request->input('company_name');
        $setting->save();

        return redirect()->route('settings.company.edit')->with('success', 'Cập nhật thành công');
    }
}
