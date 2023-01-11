<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    private function setActive($ids, $user, $active) : void {
        foreach ($ids as $id) {
            $ticket = Ticket::find($id);
            if($user->id === $ticket->sender_id) {
                if ($ticket->active !== $active) {
                    $ticket->update([
                        'active' => $active,
                    ]);
                }
            }
            else {
                $redirect = Redirect::whereUserIdAndTicketId($user->id, $ticket->id)->first();
                if ($redirect->active !== $active) {
                    $redirect->update([
                        'active' => $active,
                    ]);
                }
            }
        }
    }

    public function index(): View
    {
        /* @var User $user */
        $user = auth()->user();
        $title = "Zarchiwizowane sprawy";
        $form = "unarchive";
        $ticket_id = [];

        $tickets = Redirect::whereUserIdAndActive($user->id, false)->get('ticket_id');

        for ($i = 0, $iMax = count($tickets); $i < $iMax; $i++) {
            $ticket_id[$i] = $tickets[$i]["ticket_id"];
        }

        $tickets = Ticket::sortable()->latest()
            ->whereIn('id', $ticket_id)->orWhere('sender_id', $user->id)
            ->where('active', false)->filter(request(['search']))
            ->simplePaginate(15)->withQueryString();

        return view('tickets.index', [
            'tickets' => $tickets,
            'users' => User::class,
            'title' => $title,
            'form' => $form
        ]);
    }

    public function archive(Request $request) : RedirectResponse {
        /** @var User $user */
        $user = auth()->user();

        $formFields = $request->validate([
            'id' => 'required'
        ]);

        $this->setActive($formFields['id'], $user, 0);

        return redirect()->back()->with('message', __('app.archive'));
    }

    public function unarchive(Request $request) : RedirectResponse {

        /** @var User $user */
        $user = auth()->user();

        $formFields = $request->validate([
            'id' => 'required'
        ]);

        $this->setActive($formFields['id'], $user, 1);

        return redirect()->back()->with('message', __('app.un_archive'));
    }
}
