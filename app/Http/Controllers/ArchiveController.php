<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index(): View
    {
        $title = "Zarchiwizowane sprawy";
        $form = "unarchive";

        return view('tickets.index', [
            'tickets' => Ticket::sortable()->where('active', 0)->filter(request(['search']))->simplePaginate(12)->withQueryString(),
            'users' => User::class,
            'title' => $title,
            'form' => $form
        ]);
    }

    public function archive(Request $request) : RedirectResponse {

        $formFields = $request->validate([
            'id' => 'required'
        ]);

        foreach ($formFields['id'] as $id) {
            $ticket = Ticket::find($id);
            if($ticket->active !== 0) {
                $ticket->update([
                    'active' => 0,
                ]);
            }
        }

        return redirect()->back()->with('message', __('app.archive'));
    }

    public function unarchive(Request $request) : RedirectResponse {

        $formFields = $request->validate([
            'id' => 'required'
        ]);

        foreach ($formFields['id'] as $id) {
            $ticket = Ticket::find($id);

            if($ticket->active !== 1) {
                $ticket->update([
                    'active' => 1,
                ]);
            }
        }

        return redirect()->back()->with('message', __('app.un_archive'));
    }
}
