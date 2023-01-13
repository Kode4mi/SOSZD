<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index(String $slug): View
    {
        $ticket = Ticket::where('slug', $slug)->first();

        $redirect = Redirect::where('ticket_id', $ticket->id)->distinct()->get('user_id');

        $users = User::whereNotIn('id', $redirect)->whereNot('id', auth()->user()->id)->get(['id', 'first_name', 'last_name']);

        return view('tickets.redirection', [
            'ticket' => $ticket,
            'users' => $users,
        ]);
    }

    public function store(Request $request, String $slug_ticket): RedirectResponse
    {
        $ticket = Ticket::where('slug', $slug_ticket)->first();

        $formFields = $request->validate([
            'user_id' => 'required'
        ], [], [
            'user_id' => __('app.user_id')
        ]);

        foreach ($formFields['user_id'] as $user) {
            $redirect = ['user_id' => $user, 'ticket_id' => $ticket->id];
            Redirect::create($redirect);
        }

        return redirect('ticket/' . $ticket->slug)->with('message', __('app.redirected_ticket'));
    }
}
