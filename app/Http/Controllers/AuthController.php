<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\User;

class AuthController extends Controller
{
    public function login()
    {
        if (auth()->guard('admin')->check()) {
            return redirect('admin');
        }
        return view("pages.auth.login");
    }
    public function DoLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('type', 'admin')->where('email', request('email'))->where('active', 'active')->first();

        if (empty($user)) {
            return back()->withInput()->with('error', "الرجاء ادخال بريد الكتروني صحيح.");
        }

        if ($user->password != request('password')) {
            return back()->withInput()->with('error', "الرجاء التأكد من كلمة المرور.");
        }

        if (auth()->guard("admin")->loginUsingId($user->id)) {
            return redirect("/admin");
        } else {
            return back()->with("error", "فشلت العملة الرجاء المحاولة مرة أخرى.");
        }
    }
}
