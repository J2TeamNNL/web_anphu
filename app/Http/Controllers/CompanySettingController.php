<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CompanySettingController extends Controller
{
    public function edit()
    {
        $setting = CompanySetting::first();
        return view('admins.settings.company.edit', [
            'setting' => $setting,
        ]);
    }

    public function update(Request $request)
    {
        $companySetting = CompanySetting::firstOrFail();

        $data = $request->except([
            '_token',
            '_method',
            'certificates',
        ]);

        // Xử lý certificates
        if ($request->hasFile('certificates')) {
            $newCertificates = [];
            foreach ($request->file('certificates') as $certificate) {
                $certificatePath = $certificate->store('assets/img/certificates', 'public');
                $newCertificates[] = $certificatePath;
            }
            $data['certificates'] = $newCertificates;
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

    public function updatePolicy(Request $request)
    {
        $request->validate([
            'policy_content' => 'nullable|string',
            'admin_password' => 'required|string',
        ]);

        // Kiểm tra mật khẩu admin
        $user = Auth::user();
        if (!$user || !Hash::check($request->input('admin_password'), $user->password)) {
            return redirect()->back()
                ->withErrors(['admin_password' => 'Mật khẩu quản trị viên không đúng.'])
                ->withInput();
        }

        $companySetting = CompanySetting::first() ?? new CompanySetting();

        // Lưu thẳng nội dung policy, không xử lý Base64
        $companySetting->policy_content = $request->input('policy_content', '');
        $companySetting->save();

        return redirect()->back()->with('success', 'Cập nhật chính sách công ty thành công!');
    }
}
