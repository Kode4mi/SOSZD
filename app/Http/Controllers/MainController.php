<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function index()
    {
        return view('main/main', [
            'tickets' => Ticket::all(),
        ]);
    }
}
