<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(): View
    {
        return view('/user/edit');
    }

    public function login(): View
    {
        return view('/user/login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $formFields = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required']
            ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('tickets')->with('message', 'Pomyślnie zalogowano');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Pomyślnie wylogowano');
    }

}
