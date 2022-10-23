<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    function index()
    {
        return view('tickets/index', [
            'tickets' => Ticket::all(),
        ]);
    }

    function create()
    {
        return view('tickets/create');
    }

    function show(Ticket $ticket)
    {
        return view('tickets/show', [
            'ticket' => $ticket,
        ]);
    }

    function store(Request $request)
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
