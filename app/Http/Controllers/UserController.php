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
        return view('user.edit');
    }


    public function login(): View
    {
        return view('user.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $formFields = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [],
            [
                'password' => __('app.password')
            ]
        );

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('tickets')->with('message', __('app.login'));
        }

        return back()->withErrors(['email' => __('auth.failed')])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', __('app.logout'));
    }

    public function update(Request $request): RedirectResponse
    {
        /* @var User $user */
        $user = auth()->user();

        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ],
        [],
            [
                'password' => __('app.password')
            ]
        );

        if(Hash::check($formFields['password'], $user->password))
        {
            unset($formFields['password']);

            $user->update($formFields);

            return redirect()->back()->with('message', __('app.user.edit'));
        }

        return redirect()->back()->withErrors(['password' => __('auth.password')]);
    }

    public function editPassword(): View
    {
        return view('user.password-change');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        /* @var User $user */
        $user = auth()->user();

        $formFields = $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'confirmed'],
        ], [],
            [
                'old_password' => 'Stare hasło',
                'password' => __('app.password')
            ]
        );



        if(!Hash::check($formFields['old_password'], $user->password))
        {
            return redirect()->back()->with('message', __('app.old_password'));
        }

        if(Hash::check($formFields['password'], $user->password))
        {
            return redirect()->back()->with('message', __('app.new_password'));
        }

        unset($formFields['old_password']);

        $formFields['password'] = bcrypt($formFields['password']);

        $user->update($formFields);

        return redirect()->back()->with('message', __('app.password_change'));
    }

    public function index(): View
    {
        return view('user.index',[
            'users' => User::sortable()->filter(request(['search']))->simplePaginate(20)
        ]);
    }
}
