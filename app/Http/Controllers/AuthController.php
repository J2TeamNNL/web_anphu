<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Events\UserRegisteredEvent;

use App\Http\Requests\StoreAuthRequest;
use App\Http\Requests\UpdateAuthRequest;

class AuthController extends Controller
{   

    public function login()
    {
        return view('auths.login');
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

        } catch (\Throwable $e) 
        {
            return redirect()->route('auths.login');
            
        } catch (\Throwable $e) 
        {
            return redirect()->route('auths.login')->withErrors(['email' => 'Something went wrong' . $e->getMessage()]);
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('auths.login');
    }

    public function register()
    {
        return view('auths.register');
    }

    public function processRegister(Request $request)
    {
        $user = User::query()
        ->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        UserRegisteredEvent::dispatch($user);
        // Dispatch the event after user registration

        return redirect()->route('auths.login')->with('success', 'Registration successful! Please log in.');
    }
}
