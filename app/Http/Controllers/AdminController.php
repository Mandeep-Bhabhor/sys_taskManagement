<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('view.admindash')->with('success', 'User registered successfully.');
    }

    public function manage_users()
    {
        $users = User::whereNot('role', 'admin')->get();

        return view('admin.manage_users', compact('users'));
    }

    public function user_ban($id)
    {

        $user = User::FindOrFail($id);

        if ($user->is_active) {
            $user->is_active = 0; // ban
            $user->save();
        }

        return back()->with('danger', 'User has been banned.');
    }

    public function user_activate($id)
    {

        $user = User::FindOrFail($id);

        if (! $user->is_active) {
            $user->is_active = 1; // activate
        $user->save();
    }

    return back()->with('success', 'User has been activated.');
    }
}
