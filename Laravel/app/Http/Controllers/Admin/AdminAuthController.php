<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('Admin.Auth.login');
    }

    public function doLogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:191|exists:admins,email',
            'password' => 'required|string'
        ]);

        if (!auth()->guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return back()->withErrors('Invalid Email Or Password');
        } else {
            return redirect(route('admin.home'));
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect(route('admin.login'));
    }



}
