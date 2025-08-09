<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanySettingRequest;
use Illuminate\Http\Request;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Services\CloudinaryService;

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
        $setting->international_name = $request->input('international_name');
        $setting->director = $request->input('director');
        $setting->company_email = $request->input('company_email');
        $setting->company_phone_1 = $request->input('company_phone_1');
        $setting->company_phone_2 = $request->input('company_phone_2');
        $setting->company_address_1 = $request->input('company_address_1');
        $setting->company_address_2 = $request->input('company_address_2');
        $setting->working_hours = $request->input('working_hours');
        $setting->policy_content = $request->input('policy_content');
        $setting->google_map = $request->input('google_map');

        $setting->established_date = $request->input('established_date');
        $setting->tax_code = $request->input('tax_code');

        


        // Nếu cần decode JSON
        $socialLinks = $request->input('social_links');
        $setting->social_links = json_decode($socialLinks, true) ?? [];

        $setting->save();

        return redirect()->route('admin.settings.company.edit')
            ->with('success', 'Cập nhật thành công');
    }


    public function editPolicy()
    {
        $policyContent = CompanySetting::value('policy_content') ?? '';

        return view('admins.settings.policy.edit', [
            'policyContent' => $policyContent,
        ]);
    }

    public function updatePolicy(Request $request, CloudinaryService $cloudinaryService)
    {
        $request->validate([
            'policy_content' => 'nullable|string',
        ]);

        $adminPassword = $request->input('admin_password');

        // Kiểm tra mật khẩu admin với user hiện tại
        $user = Auth::user();
        if (!$user || !Hash::check($adminPassword, $user->password)) {
            return redirect()->back()
                ->withErrors(['admin_password' => 'Mật khẩu quản trị viên không đúng.'])
                ->withInput();
        }

        $companySetting = CompanySetting::first() ?? new CompanySetting();

        $policyContent = $request->input('policy_content', '');

        $result = ImageHelper::extractAndUploadBase64Images($policyContent);

        $companySetting->policy_content = $result['content'];
        $companySetting->save();

        Media::whereNull('mediaable_id')
            ->where('type', 'image')
            ->whereIn('file_path', $result['paths'])
            ->update([
                'mediaable_id' => $companySetting->id,
                'mediaable_type' => CompanySetting::class,
            ]);

        return redirect()->back()->with('success', 'Cập nhật chính sách công ty thành công!');
    }

}
