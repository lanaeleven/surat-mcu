<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function login() {
        $readonly = false;
        $title = "LOGIN";
        return view('login', compact('readonly', 'title'));
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            // return redirect()->intended('dashboard');
            return redirect()->intended('/');
        }
 
        return back();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();    
        $request->session()->invalidate();    
        $request->session()->regenerateToken();    
        return redirect('/');
    }
}
