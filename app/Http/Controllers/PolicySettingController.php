<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;

class PolicySettingController extends Controller
{
    public function index()
    {
        $policy = GeneralSetting::first();
        return view('admins.settings.policy.edit', compact('policy'));
    }

    public function edit()
    {
        $policy = GeneralSetting::first();
        return view('admins.settings.policy.edit', compact('policy'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'terms' => 'nullable|string',
            'privacy' => 'nullable|string',
        ]);

        $policy = GeneralSetting::first();
        $policy->update($request->all());

        return redirect()->back()->with('success', 'Cập nhật chính sách thành công');
    }
}
