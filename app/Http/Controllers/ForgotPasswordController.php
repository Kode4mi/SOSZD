<?php

namespace App\Http\Controllers;

use App\Jobs\forgetPasswordEmailJob;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function showForgetPassword(): View
    {
        return view('user.forget-password');
    }

    public function submitForgetPassword(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
            'email' => 'required|email|exists:users',
        ],
            [
                'exists' => __('passwords.user')
            ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $formFields['email'],
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        dispatch(new forgetPasswordEmailJob($token, $formFields['email']));

        return redirect('login')->with('message', __('passwords.sent'));
    }

    public function showResetPassword($token): View
    {
        return view('user.forget-password-link', ['token' => $token]);
    }

    public function submitResetPassword(Request $request, string $token): RedirectResponse
    {

        $formFields = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|confirmed',
        ],
            [
                'exists' => __('passwords.user')
            ],
            [
                'password' => __('app.password')
            ]
        );

        $user = User::where('email', $formFields['email'])->first();

        if (Hash::check($formFields['password'], $user->password)) {
            return redirect()->back()->with('message', __('app.new_password'));
        }

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $formFields['email'],
                'token' => $token
            ])
            ->first();

        if (!$updatePassword) {
            return redirect()->back()->withErrors(['email' => __('passwords.token')]);
        }

        $user->update(['password' => bcrypt($formFields['password'])]);

        DB::table('password_resets')->where(['email' => $formFields['email']])->delete();

        return redirect('/login')->with('message', __('passwords.reset'));
    }

}
