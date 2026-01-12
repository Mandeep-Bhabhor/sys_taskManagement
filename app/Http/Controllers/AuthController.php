<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //
    public function login(Request $req)
    {
        $creds = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //    $user = User::where('email', $req->email)
        //         ->where('password', $req->password)
        //         ->first();

      if(Auth::attempt($creds)){

      $req->session()->regenerate();

      $user=Auth::user();

      if($user->role === 'admin'){
        return redirect()->route('view.admindash');
      }elseif($user->role === 'manager'){
        return redirect()->route('view.managerdash');
      }elseif($user->role === 'staff'){
        return redirect()->route('view.staffdash');
      }
      }
    }



    ///View Controllers 
    public function admindash(){
        return view('admin.dashboard');
    }

     public function managerdash(){
        return view('manager.dashboard');
    }

     public function staffdash(){
        return view('staff.dashboard');
    } 

    public function viewregister(){
        return view('admin.register');
    }


    ///logout function 

    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect()->route('view.login');
    }
}
