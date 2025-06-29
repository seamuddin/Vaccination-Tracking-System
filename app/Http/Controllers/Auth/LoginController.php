<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modules\User\Models\User;

class LoginController extends Controller
{
    public function login()
    {

        if (Auth::check()) {
            $user = Auth::user();
            $roleSlug = $user->role->slug ?? null; // Assuming User has 'role' relationship with 'slug' attribute
            if (in_array($roleSlug, ['admin', 'health-worker'])) {
                return redirect()->intended('dashboard');
            } elseif ($roleSlug === 'parent') {
                return redirect()->intended('guardian_portfolio');
            }
        }
        return view('auth.login');
    }


    public function loginCheck(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            if (Auth::check()) {
                $user = Auth::user();
                $roleSlug = $user->role->slug ?? null;
                if (in_array($roleSlug, ['admin', 'health-worker'])) {
                    return redirect()->intended('dashboard');
                } elseif ($roleSlug === 'parent') {
                    return redirect()->intended('guardian_portfolio');
                }
            }
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }



    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['role_id'] = 4;
        $data['user_type'] = 'general';

        // dd($data);
        // Assuming you have a User model
        User::create($data);

        return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
