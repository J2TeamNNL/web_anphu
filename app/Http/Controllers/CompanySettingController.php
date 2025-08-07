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
        return view('admins.settings.company.edit', [
            'setting' => $setting,        
        ]);
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

        // Cập nhật tất cả các trường còn lại
        $setting->company_name = $request->input('company_name');
        $setting->company_email = $request->input('company_email');
        $setting->company_phone_1 = $request->input('company_phone_1');
        $setting->company_phone_2 = $request->input('company_phone_2');
        $setting->company_address_1 = $request->input('company_address_1');
        $setting->company_address_2 = $request->input('company_address_2');
        $setting->working_hours = $request->input('working_hours');
        $setting->policy_content = $request->input('policy_content');
        $setting->google_map = $request->input('google_map');

        // Nếu cần decode JSON
        $socialLinks = $request->input('social_links');
        $setting->social_links = json_decode($socialLinks, true) ?? [];

        $setting->save();

        return redirect()->route('admin.settings.company.edit')
            ->with('success', 'Cập nhật thành công');
    }

    public function editPolicy()
    {
        return view('admins.settings.policy.edit', [     
            //
        ]);
    }

    public function updatePolicy()
    {
        //
    }
}
