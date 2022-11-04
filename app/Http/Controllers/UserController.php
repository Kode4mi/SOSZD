<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function update(Request $request): RedirectResponse
    {
        /* @var User $user */
        $user = auth()->user();

        $formFields = $request->validate([
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'password' => ['required', 'confirmed'],
        ]);

        if(Hash::check($formFields['password'], $user->password))
        {
            unset($formFields['password']);

            $user->update($formFields);

            return redirect()->back()->with('message', 'Zmieniono dane użytkownika');
        }

        return redirect()->back()->with('message', 'Hasło niepoprawne');
    }

}
