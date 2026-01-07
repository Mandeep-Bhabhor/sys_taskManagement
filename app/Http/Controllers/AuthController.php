<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(Request $req)
    {
        validator($req->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ])->validate();

       $user = User::where('email', $req->email)
            ->where('password', $req->password)
            ->first();

        if ($user) {
            // Log the user in
            auth()->login($user);
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }
}
