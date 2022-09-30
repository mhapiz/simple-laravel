<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('admin.dashboard');
        } else { // false
            //Login Fail
            return view('pages.auth.login');
        }
    }

    public function loginProcess(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        Auth::attempt(['username' => $request->username, 'password' => $request->password]);

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('admin.dashboard');
        } else { // false
            Alert::toast('Username / Password Tidak Cocok!', 'error');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
