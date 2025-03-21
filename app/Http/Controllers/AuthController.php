<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $sanitize = [
            'username' => strip_tags($request->input('username')),
            'password' => strip_tags($request->input('password'))
        ];

        $credential = Validator::make($sanitize, [
            'username' => ['required', 'string', 'min:6', 'max:20'],
            'password' => ['required', 'string', 'min:6', 'max:20']
        ])->validate();

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard.index')->with('message', 'Welcome ' . Auth::user()->name);
        }

        return redirect()->route('login')->withInput()->withErrors(['login' => 'Invalid username or password!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('logout', 'logout success!');
    }
}
