<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Symfony\Component\Clock\now;

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

            if (Auth::user()->password_updated_at === null) {
                return redirect()->route('changePasswordFirstTime')->with('message', 'Login sucess, change password for the first time to continue!');
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

    public function changePassword(Request $request)
    {
        $sanitize = [
            'oldPassword' => strip_tags($request->input('oldPassword')),
            'newPassword' => strip_tags($request->input('newPassword')),
            'confirmNewPassword' => strip_tags($request->input('confirmNewPassword'))
        ];

        $credential = Validator::make($sanitize, [
            'oldPassword' => ['required', 'string', 'min:8', 'max:20'],
            'newPassword' => ['required', 'string', 'min:8', 'max:20'],
            'confirmNewPassword' => ['required', 'string', 'min:8', 'max:20', 'same:newPassword'],
        ])->validate();

        $user = Auth::user();

        if (!Hash::check($credential['oldPassword'], $user->getAuthPassword())) {
            return redirect()->back()->withErrors(['error' => 'Invalid old password!']);
        }


        $update =  User::whereId(Auth::id())->update([
            'password' => Hash::make($credential['newPassword']),
            'password_updated_at' => now(),
        ]);

        if (!$update) {
            return redirect()->back()->withErrors(['error', 'Failed to update password!']);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('logout', 'success to update password,Please login again with new password!');
    }

    public function changePasswordFirstTime(Request $request)
    {
        $sanitize = [
            'newPassword' => strip_tags($request->input('newPassword')),
            'confirmNewPassword' => strip_tags($request->input('confirmNewPassword'))
        ];

        $credential = Validator::make($sanitize, [
            'newPassword' => ['required', 'string', 'min:8', 'max:20'],
            'confirmNewPassword' => ['required', 'string', 'min:8', 'max:20', 'same:newPassword'],
        ])->validate();

        $user = Auth::user();

        $update =  User::whereId(Auth::id())->update([
            'password' => Hash::make($credential['newPassword']),
            'password_updated_at' => now(),
        ]);

        if (!$update) {
            return redirect()->back()->withErrors(['error', 'Failed to update password!']);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('logout', 'success to update password,Please login again with new password!');
    }

    public function adminProfile()
    {
        return view('admin.profile', [
            'active' => '',
            'open' => '',
            'link' => ' Profile | ',
        ]);
    }

    public function updateProfile(Request $request)
    {
        return $request;
    }
}
