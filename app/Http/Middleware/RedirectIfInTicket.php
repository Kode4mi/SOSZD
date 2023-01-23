<?php

namespace App\Http\Middleware;

use App\Models\Ticket;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RedirectIfInTicket
{
    public function handle(Request $request, Closure $next) : Response|RedirectResponse
    {
        $ticket = Ticket::whereSlug($request->slug)->first();

        if($ticket->sender_id === auth()->user()->id) {
            return $next($request);
        }

        return redirect('tickets')->with('message', __('app.cant_do_that'));
    }
}
