<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function index(): View
    {
        return view('tickets/index', [
            'tickets' => Ticket::sortable()->simplePaginate(20),
        ]);
    }

    public function create(): View
    {
        return view('tickets/create');
    }

    public function show(Ticket $ticket): View
    {
        return view('tickets/show', [
            'ticket' => $ticket,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
            'temat' => 'required',
            'opis' => 'required',
            'termin' => 'required',
            'priorytet' => 'required',
        ]);

        Ticket::create($formFields);

        return redirect('tickets');
    }

}
