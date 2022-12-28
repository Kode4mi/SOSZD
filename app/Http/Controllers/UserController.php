<?php

namespace App\Http\Controllers;

use App\Jobs\newUserEmailJob;
use App\Models\Redirect;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        if (Hash::check($formFields['password'], $user->password)) {
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

        if (!Hash::check($formFields['old_password'], $user->password)) {
            return redirect()->back()->with('message', __('app.old_password'));
        }

        if (Hash::check($formFields['password'], $user->password)) {
            return redirect()->back()->with('message', __('app.new_password'));
        }

        unset($formFields['old_password']);

        $formFields['password'] = bcrypt($formFields['password']);

        $user->update($formFields);

        return redirect()->back()->with('message', __('app.password_change'));
    }

    public function index(): View
    {
        return view('user.index', [
            'users' => User::sortable()->filter(request(['search']))->simplePaginate(15)->withQueryString()
        ]);
    }

    public function register(): View|RedirectResponse
    {
        if (auth()->user()->role === "admin") {
            return view('user.create');
        }

        return redirect('tickets')->with('message', __('app.access_denied'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (auth()->user()->role === "admin") {
            $formFields = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => ['required', 'email', 'unique:users'],
                'role' => 'nullable',
            ], [],
                [
                    'first_name' => __('app.first_name'),
                    'last_name' => __('app.last_name'),
                    'role' => __('app.role'),
                ]);

            if (!isset($formFields["role"])) {
                $formFields += ["role" => "nauczyciel"];
            }

            $formFields += ["password" => "nie ustawiono"];

            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $formFields['email'],
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            dispatch(new newUserEmailJob($token, $formFields['email']));

            User::create($formFields);

            return redirect('/users')->with('message', __('app.user.create'));
        }

        return redirect('tickets')->with('message', __('app.access_denied'));
    }

    public function showCreatePassword($token): View
    {
        return view('user.new-user', ['token' => $token]);
    }

    public function submitCreatePassword(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
            'password' => 'required|confirmed',
            'token' => 'required',
        ], [],
            [
                'password' => __('app.password')
            ]);

        $createPassword = DB::table('password_resets')
            ->where(['token' => $formFields['token']])
            ->first();

        if (!$createPassword) {
            return redirect()->back()->withErrors(['email' => __('passwords.token')]);
        }

        User::where('email', $createPassword->email)
            ->update(['password' => bcrypt($formFields['password'])]);

        DB::table('password_resets')->where(['token' => $formFields['token']])->delete();

        return redirect('/login')->with('message', __('app.password_set'));
    }

    public function show(User $user): View|RedirectResponse
    {
        return view('user.show', ['user' => $user]);
    }

    public function updateByAdmin(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'nullable',
        ],
            [],
             [
                 'first_name' => __('app.first_name'),
                 'last_name' => __('app.last_name'),
                 'role' => __('app.role')
             ]
        );

        $user = User::where('email', $formFields['email'])->first();

        $user->update($formFields);

        return redirect()->back()->with('message', __('app.user.edit'));
    }
}
