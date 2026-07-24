<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $userData = [
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'xp' => 0,
            'level' => 1,
            'streak' => 1,
            'last_login' => now(),
        ];

        if (Schema::hasColumn('users', 'name')) {
            $userData['name'] = $validated['username'];
        }
        if (Schema::hasColumn('users', 'email')) {
            $userData['email'] = $validated['username'].'@engpersona.local';
        }

        $user = User::create($userData);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ])->onlyInput('username');
        }

        $request->session()->regenerate();

        /** @var User $user */
        $user = Auth::user();
        $today = Carbon::today();
        $lastLogin = $user->last_login?->copy()->startOfDay();

        if (! $lastLogin) {
            $user->streak = 1;
        } else {
            $diffDays = $lastLogin->diffInDays($today, false);
            if ($diffDays >= 1) {
                $user->streak += 1;
            }
        }

        $user->last_login = now();
        $user->save();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
