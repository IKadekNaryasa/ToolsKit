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

            $user = Auth::user();

            if (!$user) {
                Auth::logout();
                return redirect()->route('login')->withErrors(['login' => 'Authentication failed.']);
            }

            // return $user;
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard.index')->with('message', 'Welcome ' . $user->name);
            } elseif ($user->role === 'technician') {
                return redirect()->route('admin.dashboard.index')->with('message', 'Welcome Teknisi ' . $user->name);
            } elseif ($user->role === 'head') {
                return redirect()->route('admin.dashboard.index')->with('message', 'Welcome Head' . $user->name);
            }
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
