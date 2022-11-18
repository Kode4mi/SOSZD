<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(): View
    {
        $title = "Aktualne sprawy";
        $form = "archive";

        return view('tickets.index', [
            'tickets' => Ticket::sortable()->where('active', 1)->filter(request(['search']))->simplePaginate(12),
            'users' => User::class,
            'title' => $title,
            'form' => $form
        ]);
    }

    public function archives(): View
    {
        $title = "Zarchiwizowane sprawy";
        $form = "unarchive";

        return view('tickets.index', [
            'tickets' => Ticket::sortable()->where('active', 0)->filter(request(['search']))->simplePaginate(12),
            'users' => User::class,
            'title' => $title,
            'form' => $form
        ]);
    }

    public function create(): View
    {
        return view('tickets.create');
    }

    public function show(Ticket $ticket): View
    {
        return view('tickets.show', [
            'ticket' => $ticket,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'priority' => 'required',
        ],
        [],
            [
                'title' => __('app.title'),
                'description' => __('app.description'),
                'deadline' => __('app.deadline'),
                'priority' => __('app.priority')
            ]
        );

        /* @var User $user */
        $user = auth()->user();

        $formFields += [
            'sender_id' => $user->id,
        ];

        Ticket::create($formFields);

        return redirect('tickets')->with('message', __('app.ticket.create'));
    }

    public function archive(Request $request) : RedirectResponse {

        $formFields = $request->validate([
           'id' => 'required'
        ]);

        foreach ($formFields['id'] as $id) {
            $ticket = Ticket::find($id);

            $ticket->update([
                'active' => 0,
            ]);
        }

        return redirect()->back()->with('message', 'Zarchiwizowano sprawę/sprawy');
    }

    public function unarchive(Request $request) : RedirectResponse {

        $formFields = $request->validate([
            'id' => 'required'
        ]);

        foreach ($formFields['id'] as $id) {
            $ticket = Ticket::find($id);

            $ticket->update([
                'active' => 1,
            ]);
        }

        return redirect()->back()->with('message', 'Przywrócono sprawę/sprawy');
    }


}
