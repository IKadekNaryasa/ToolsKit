<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class GlobalUserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $sanitize = [
            'name' => e($request->input('name')),
            'user_id' => $request->input('user_id'),
            'username' => e($request->input('username')),
            'contact' => e($request->input('contact'))
        ];
        $id = $sanitize['user_id'];
        $credential = Validator::make($sanitize, [
            'name' => ['required', 'string'],
            'user_id' => ['required', 'exists:users,id'],
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore($id)],
            'contact' => ['required', 'string']
        ])->validate();

        $data = [
            'name' => $credential['name'],
            'username' => $credential['username'],
            'contact' => $credential['contact']
        ];

        $user = User::find($id);
        $oldUsername = $user->username;
        DB::transaction(function () use ($user, $data) {
            $user->update($data);
        });

        if ($data['username'] !== $oldUsername) {
            Auth::logout();
            session()->invalidate();
            session()->regenerate();
            return redirect()->route('login')->with('logout', 'username updated, please login again with new username!');
        }

        session()->regenerate();

        return redirect()->back()->with('message', 'Success to update profile!');
    }

    public function adminProfile()
    {
        return view('admin.profile', [
            'active' => '',
            'open' => '',
            'link' => ' Profile | ',
        ]);
    }
}
