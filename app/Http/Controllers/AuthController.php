<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login
    public function login() {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    // Login attempt
    public function loginAttempt(Request $request) {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('danger', 'Fail to login! Check your email & password!');
        }
    }

    // Logout
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
