<?php

namespace App\Http\Controllers;

use App\Jobs\forgetPasswordEmailJob;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function showForgetPassword(): View
    {
        return view('user.forget-password');
    }

    public function submitForgetPassword(Request $request) : RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        dispatch(new forgetPasswordEmailJob($token, $request->email));

        return back()->with('message', 'Wysłaliśmy email z linkiem resetującym hasło!');
    }

    public function showResetPassword($token) : View {
        return view('user.forget-password-link', ['token' => $token]);
    }

    public function submitResetPassword(Request $request) : RedirectResponse
    {

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|confirmed',
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword){
            return redirect()->back()->with('message', 'Nie właściwy token!');
        }

        User::where('email', $request->email)
            ->update(['password' => bcrypt($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with('message', 'Twoje hasło zostało zmienione!');
    }

}
