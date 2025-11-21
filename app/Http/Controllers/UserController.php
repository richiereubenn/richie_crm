<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:4|max:50|unique:users,username',
            'password' => 'required|string|min:8|regex:/^(?=.*[0-9])(?=.*[!@#$%^&*])/',
            'role' => 'required|in:Admin,Manager,Sales',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User has been successfully created!');;
    }

    public function edit(User $user)
    {
        return view('users.create', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|min:4|max:50|unique:users,username',
            'role' => 'required|in:Admin,Manager,Sales',
        ]);

        $data = [
            'username' => $request->username,
            'role' => $request->role,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route(route: 'users.index')
            ->with('success', 'User has been successfully edited!');;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
