<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index(): View
    {
        $title = "Aktualne sprawy";
        $form = "archive";

        /* @var User $user */
        $user = auth()->user();

        if ($user->role === "nauczyciel") {
            $ticket_id = [];

            $tickets = Redirect::where("user_id", $user->id)->get('ticket_id');

            for ($i = 0, $iMax = count($tickets); $i < $iMax; $i++) {
                $ticket_id[$i] = $tickets[$i]["ticket_id"];
            }

            $tickets = Ticket::sortable()->latest()->where('active', 1)->whereIn('id', $ticket_id)->orWhere('sender_id', $user->id)->filter(request(['search']))->simplePaginate(15)->withQueryString();
        } else {
            $tickets = Ticket::sortable()->latest()->where('active', 1)->filter(request(['search']))->simplePaginate(15)->withQueryString();
        }

        return view('tickets.index', [
            'tickets' => $tickets,
            'users' => User::class,
            'title' => $title,
            'form' => $form
        ]);
    }

    public function create(): View
    {
        return view('tickets.create');
    }

    public function show($slug): View|RedirectResponse
    {
        $redirect = "";

        $ticket = Ticket::where('slug', $slug)->first();


        /* @var User $user */
        $user = auth()->user();
        if ($user->role === "nauczyciel") {
            $redirect = Redirect::where('ticket_id', $ticket->id)->where('user_id', $user->id)->get();

            if ($ticket->sender_id === $user->id) {
                $redirect = "";
            } else if ($redirect->isEmpty()) {
                return redirect("/tickets")->with("message", __('app.ticket.access_denied'));
            } else {
                $redirect = Redirect::find($redirect[0]['id'])->update(['read' => true]);
            }
        }

        $redirects = Redirect::where('ticket_id', $ticket->id)->get(['id', 'user_id', 'read'])->toArray();

        $i = 0;
        $users = [];

        foreach ($redirects as $redirect) {
            $users[$i] = ['user_id' => $redirect['user_id'], 'read' => $redirect['read']];
            $i++;
        }

        $i = 0;

        foreach ($users as $user) {
            $userData = User::where("id", $user['user_id'])->first(['id', 'first_name', 'last_name'])->toArray();
            $users[$i] += $userData;
            $i++;
        }

        $sender = User::where("id", $ticket->sender_id)->first(['first_name', 'last_name']);

        $redirect = Redirect::where('ticket_id', $ticket['id'])->where('user_id', auth()->user()->id)->first();

        if ($users === []) {
            $users = User::whereNot('id', auth()->user()->id)->get(['id', 'first_name', 'last_name']);
        }

        $slug = Ticket::where('slug', $ticket->slug);

        return view('tickets.show', [
            'ticket' => $ticket,
            'users' => $users,
            'sender' => $sender,
            'redirect' => $redirect,
        ])->with('slug', $slug);
    }

        // public function show($slug){
        //     $game = Game::where('slug', $slug)->first();
        //     return view('game.show')->with('game', $game);
        // }

    public function store(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'priority' => 'required',
            'files' => 'nullable'
        ],
            [],
            [
                'title' => __('app.title'),
                'description' => __('app.description'),
                'deadline' => __('app.deadline'),
                'priority' => __('app.priority'),
                'files' => __('app.files')
            ]
        );

        if ($request->hasFile('files')) {
            $file_names = "";

            foreach ($formFields['files'] as $file) {
                $file_names .= $file->store('files', 'public') . ";";
            }

            $formFields['files'] = $file_names;

        }

        /* @var User $user */
        $user = auth()->user();

        $formFields += [
            'sender_id' => $user->id,
            'slug' => "placeholder"
        ];

        $ticket = Ticket::create($formFields);

        $slug = md5($ticket->id."-".$ticket->title.$ticket->created_at);

        $ticket->update(['slug' => $slug]);

        return redirect("ticket/$ticket->slug")->with('message', __('app.ticket.create'));
    }



}
