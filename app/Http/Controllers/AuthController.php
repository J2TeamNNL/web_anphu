<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Events\UserRegisteredEvent;

class AuthController extends Controller
{   

    public function login()
    {
        $title = 'Đăng nhập';
        return view('auths.login', compact('title'));
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.portfolios.index');
        }

        return redirect()->route('auths.login')
            ->withErrors(['message' => 'Email hoặc mật khẩu không đúng.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auths.login');
    }

    public function register()
    {
        $title = 'Đăng ký tài khoản';
        return view('auths.register', compact('title'));
    }

    public function processRegister(Request $request)
    {
        $user = User::query()
        ->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'avatar' => 'default-avatar.png',
            'level' => 1,
        ]);

        UserRegisteredEvent::dispatch($user);
        // Dispatch the event after user registration

        return redirect()->route('auths.login')
        ->with('success', 'Registration successful! Please log in.');
    }
}
