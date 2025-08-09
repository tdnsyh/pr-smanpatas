<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    // form pendaftaran
    public function showRegisterForm()
    {
        $title='Daftar';
        return view('auth.register',compact('title'));
    }

    // pendaftaran akun, default adalah owner
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'operator',
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }

    public function showLoginForm(Request $request)
    {
        if ($request->has('redirect_to')) {
            session(['redirect_to' => $request->redirect_to]);
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (session()->has('redirect_to')) {
                $redirect = session('redirect_to');
                session()->forget('redirect_to');
                return redirect($redirect)->with('success', 'Login berhasil!');
            }

            $role = Auth::user()->role;

            if ($role === 'bendahara') {
                return redirect()->route('bendahara.dashboard.index')->with('success', 'Login berhasil!');
            } elseif ($role === 'sekretaris') {
                return redirect()->route('sekretaris.dashboard.index')->with('success', 'Login berhasil!');
            } elseif ($role === 'media') {
                return redirect()->route('media.dashboard.index')->with('success', 'Login berhasil!');
            } elseif ($role === 'operator') {
                return redirect()->route('operator.dashboard.index')->with('success', 'Login berhasil!');
            } elseif ($role === 'alumni') {
                return redirect()->route('alumni.dashboard.index')->with('success', 'Login berhasil!');
            }

            Auth::logout();
            return back()->withErrors([
                'email' => 'Role pengguna tidak valid.',
            ])->withInput();
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput()->with('error','Email atau Password Salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }

    protected function authenticated(Request $request, $user)
    {
        if (session()->has('redirect_to')) {
            $redirect = session('redirect_to');
            session()->forget('redirect_to');
            return redirect($redirect);
        }

        return redirect()->intended(route('/'));
    }

}
