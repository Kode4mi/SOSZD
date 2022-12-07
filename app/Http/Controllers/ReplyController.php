<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReplyController extends Controller
{

    public function create(Redirect $redirect) : RedirectResponse|View
    {
        if(auth()->user()->id === $redirect->user_id || auth()->user()->role === "admin") {
            return View('tickets.reply', [
                'redirect' => $redirect,
                'ticket' => Ticket::find($redirect->ticket_id),
            ]);
        }
        return redirect('tickets')->with('message', 'Nie możesz tego zrobić');
    }

    public function store(Request $request, Redirect $redirect) : RedirectResponse {

        $formFields = $request->validate([
            'message' => 'required',
            'files' => 'nullable',
        ]);

        if($request->hasFile('files')) {
            $file_names = "";

            foreach ($formFields['files'] as $file) {
                $file_names .= $file->store('files', 'public').";";
            }

            $formFields['files'] = $file_names;
        }

        $formFields = array_merge($formFields, ['redirect_id' => $redirect->id]);

        Reply::create($formFields);

        return redirect("tickets")->with("message", "Odpowiedź pomyślnie przesłana");
    }

}
