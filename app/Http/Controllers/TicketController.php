<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class TicketController extends Controller
{
    public function index(): View
    {
        $title = "Aktualne sprawy";
        $form = "archive";
        $ticket_id = [];

        $tickets = Redirect::where("user_id", auth()->user()->id)->get('ticket_id');

        for ($i = 0, $iMax = count($tickets); $i < $iMax; $i++) {
            $ticket_id[$i] = $tickets[$i]["ticket_id"];
        }

        return view('tickets.index', [
            'tickets' => Ticket::sortable()->latest()->where('active', 1)->whereIn('id', $ticket_id)->filter(request(['search']))->simplePaginate(12),
            'users' => User::class,
            'title' => $title,
            'form' => $form
        ]);
    }

    public function create(): View
    {
        return view('tickets.create');
    }

    public function show(Ticket $ticket): View | RedirectResponse
    {
        /* @var User $user */
        $user = auth()->user();

        $redirect = Redirect::where('ticket_id', $ticket->id)->where('user_id', $user->id)->get();

        if($user->role === "nauczyciel" && $redirect->isEmpty())
        {
            return redirect("/tickets")->with("message", __('app.ticket.access_denied'));
        }

        Redirect::find($redirect[0]['id'])->update(['read' => true]);

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


}
