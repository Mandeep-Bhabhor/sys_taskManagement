<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{
    //

    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

     User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$request->password,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User registered successfully.');
    }
}
