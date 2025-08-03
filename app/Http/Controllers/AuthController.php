<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use App\Events\UserRegisteredEvent;

use App\Http\Requests\StoreAuthRequest;
use App\Http\Requests\UpdateAuthRequest;

class AuthController extends Controller
{   

    public function login()
    {
        $title = 'Đăng nhập';
        return view('auths.login', compact('title'));
    }

    public function processLogin(Request $request)
    {
        try {
            $user = User::query()
            ->where('email', $request->get('email'))
            ->firstOrFail();

            if(!Hash::check($request->get('password'), $user->password))
            {
                return redirect()->route('auths.login')
                    ->withErrors(['password' => 'Incorrect password.']);
            }

            session()->put('id', $user->id);
            session()->put('name', $user->name);
            session()->put('avatar', $user->avatar);
            session()->put('level', $user->level);

            return redirect()->route('admin.portfolios.index');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('auths.login')
                ->withErrors(['message' => 'Tài khoản không tồn tại.']);
                
        } catch (\Exception $e) {
            Log::error('Login error', [
                'error' => $e->getMessage(),
                'email' => $request->get('email')
            ]);
            return redirect()->route('auths.login')
                ->withErrors(['message' => 'Đã xảy ra lỗi. Vui lòng thử lại.']);
        }
    }

    public function logout()
    {
        session()->flush();
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

        return redirect()->route('auths.login')->with('success', 'Registration successful! Please log in.');
    }
}
