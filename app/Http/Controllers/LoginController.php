<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        // dd($credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(auth()->user()->is_admin){
                return redirect()->route('admin');
            }else{
                return redirect()->action('user');
            }
        }

        return back()->with('loginError', 'Gagal melakukan Login!!!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
