<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        $cre = $request->only('email','password');
        if (Auth::attempt($cre)) {
            return redirect('/dashboard');
        }
        return redirect()->back()->with('sukses','Email atau Password Salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }


    public function sendResetLink(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $user = DB::table('users')->where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email not found']);
    }

    $token = Str::random(64);

    DB::table('password_resets')->updateOrInsert(
        ['email' => $request->email],
        ['token' => $token, 'created_at' => Carbon::now()]
    );

    $link = url('/reset-password?token=' . $token . '&email=' . $request->email);

    // Kirim email ke pengguna
    Mail::send('emails.reset-password', ['link' => $link], function ($message) use ($request) {
        $message->to($request->email);
        $message->subject('Password Reset Link');
    });

    return back()->with('success', 'Reset link sent to your email.');
}

public function showResetForm(Request $request)
{
    return view('auth.reset-password');
}

public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $reset = DB::table('password_resets')
        ->where('email', $request->email)
        ->where('token', $request->token)
        ->first();

    if (!$reset) {
        return back()->withErrors(['email' => 'Invalid token or email.']);
    }

    DB::table('users')->where('email', $request->email)->update([
        'password' => bcrypt($request->password),
    ]);

    DB::table('password_resets')->where('email', $request->email)->delete();

    // Redirect ke halaman login dengan pesan sukses
    return redirect('/login')->with('success', 'Password has been reset. Please log in with your new password.');
}



}
