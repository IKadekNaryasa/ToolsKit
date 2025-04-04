<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view(
            'admin.user.index',
            [
                'active' => 'user',
                'open' => 'user',
                'link' => 'User | ',
                'users' => $users
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sanitize = [
            'name' => e($request->input('name')),
            'username' => e($request->input('username')),
            'contact' => e($request->input('contact')),
            'role' => e($request->input('role'))
        ];

        $credential = Validator::make($sanitize, [
            'name' => ['required', 'string'],
            'username' => ['required', 'unique:users,username'],
            'contact' => ['required', 'unique:users,contact'],
            'role' => ['required', 'in:head,admin,technician']
        ]);

        if ($credential->fails()) {
            return redirect()->route('admin.user.index')->withErrors($credential)->with('errorFrom', 'store')->withInput();
        }

        $validatedData = $credential->validate();
        $data = [
            'username' => $validatedData['username'],
            'password' => Hash::make('12345678'),
            'name' => $validatedData['name'],
            'contact' => $validatedData['contact'],
            'role' => $validatedData['role']
        ];

        DB::transaction(function () use ($data) {
            User::create($data);
        });

        return redirect()->route('admin.user.index')->with('message', 'Success!, new user created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $sanitize = [
            'name' => e($request->input('name', $user->name)),
            'username' => e($request->input('username', $user->username)),
            'contact' => e($request->input('contact', $user->contact)),
            'role' => e($request->input('role', $user->role))
        ];

        $credential = Validator::make($sanitize, [
            'name' => ['required', 'string'],
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore($user->id)],
            'contact' => ['required', Rule::unique('users', 'contact')->ignore($user->id)],
            'role' => ['required', 'in:admin,head,technician']
        ]);

        if ($credential->fails()) {
            return redirect()->route('admin.user.index')->withErrors($credential)->with('errorFrom', 'update')->with('userId', $user->id)->withInput($request->all() + ['user_id' => $user->id]);
        }

        $validatedData = $credential->validate();
        $data = [
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'contact' => $validatedData['contact'],
            'role' => $validatedData['role']
        ];
        DB::transaction(function () use ($data, $user) {
            $user->update($data);
        });

        return redirect()->route('admin.user.index')->with('message', 'Success!, user updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === Auth::user()->id) {
            return redirect()->route('admin.user.index')->withErrors(['error' => 'You cant to delete this user!']);
        }
        $user->delete();
        return redirect()->route('admin.user.index')->with('message', 'Success!, user deleted!');
    }
}
