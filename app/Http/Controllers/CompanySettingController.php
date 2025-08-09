<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanySettingRequest;
use Illuminate\Http\Request;
use App\Models\CompanySetting;
use App\Services\ImageUploadService;
use App\Models\Media;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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

    public function update(UpdateCompanySettingRequest $request, CloudinaryService $cloudinaryService)
    {
        $data = $request->validated();

        $companySetting = CompanySetting::firstOrFail();

        /** Xử lý logo */
        if ($request->hasFile('company_logo')) {
            // Xoá ảnh cũ nếu có
            if (!empty($companySetting->company_logo_public_id)) {
                $cloudinaryService->delete($companySetting->company_logo_public_id);
            }

            // Upload ảnh mới vào folder company_settings/logo
            $uploadResult = $cloudinaryService->upload($request->file('company_logo'), 'company_settings/logo');

            $data['company_logo'] = $uploadResult['url'] ?? null;
            $data['company_logo_public_id'] = $uploadResult['path'] ?? null;
        } else {
            // Giữ nguyên logo cũ
            $data['company_logo'] = $companySetting->company_logo;
            $data['company_logo_public_id'] = $companySetting->company_logo_public_id;
        }

        /** Xử lý certificates (mảng ảnh) */
        if ($request->hasFile('certificates')) {
            // Xoá tất cả ảnh cũ nếu có
            if (!empty($companySetting->certificates_public_ids) && is_array($companySetting->certificates_public_ids)) {
                foreach ($companySetting->certificates_public_ids as $publicId) {
                    $cloudinaryService->delete($publicId);
                }
            }

            $newCertificates = [];
            $newCertificatesPublicIds = [];

            foreach ($request->file('certificates') as $certificate) {
                $uploadResult = $cloudinaryService->upload($certificate, 'company_settings/certificates');
                $newCertificates[] = $uploadResult['url'] ?? null;
                $newCertificatesPublicIds[] = $uploadResult['path'] ?? null;
            }

            $data['certificates'] = $newCertificates;
            $data['certificates_public_ids'] = $newCertificatesPublicIds;
        } else {
            // Giữ nguyên certificates cũ
            $data['certificates'] = $companySetting->certificates;
            $data['certificates_public_ids'] = $companySetting->certificates_public_ids;
        }

        $companySetting->update($data);

        return redirect()->route('admin.settings.company.edit')
            ->with('success', 'Cập nhật thông tin công ty thành công!');
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
