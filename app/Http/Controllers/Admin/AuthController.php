<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\Admin;


class AuthController extends Controller
{
    public function __construct()
    {
        return $this->middleware('guest:admin')->except('logout');
    }

    public function login()
    {
        return view('backend.modules.auth.login');
    }

    public function do_login(Request $r)
    {
        $rules = [];
        $validate =  Validator::make($r->all(), $rules);
        if ($validate->fails()) {
            return redirect()->route('admin.login')->with('error', 'Gerekli alanları boş bırakmayınız.');
        }
        $checkAdmin = Admin::where('email', $r->email)->first();
        if ($checkAdmin) {
            if (Auth::guard('admin')->attempt(['email' => $r->email, 'password' => $r->password], true)) {
                return redirect()->route('admin.dashboard')->with('successLogin', 'Başarıyla giriş yaptınız.');
            } else {
                return redirect()->route('admin.login')->with('error', 'Bilgilerinizi kontrol ediniz.');
            }
        } else {
            return redirect()->route('admin.login')->with('error', 'Böyle bir kullanıcı mevcut değil.');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();
        return redirect()->route('admin.login');
    }
}
