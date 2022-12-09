<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReplyController extends Controller
{

    public function create(Redirect $redirect) : RedirectResponse|View
    {
        /** @var User $user */
        $user = auth()->user();

        if((!$redirect->hasReply() && $user->id === $redirect->user_id) || $user->role === "admin") {
            return View('replies.create', [
                'redirect' => $redirect,
                'ticket' => Ticket::find($redirect->ticket_id),
            ]);
        }
        return redirect('tickets')->with('message', __('app.cant_do_that'));
    }

    public function store(Request $request, Redirect $redirect) : RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        if ((!$redirect->hasReply() && $user->id === $redirect->user_id) || $user->role === "admin") {
            $formFields = $request->validate([
                'message' => 'required',
                'files' => 'nullable',
            ]);

            if ($request->hasFile('files')) {
                $file_names = "";

                foreach ($formFields['files'] as $file) {
                    $file_names .= $file->store('files', 'public') . ";";
                }

                $formFields['files'] = $file_names;
            }

            $formFields = array_merge($formFields, ['redirect_id' => $redirect->id]);

            Reply::create($formFields);

            return redirect("tickets")->with("message", __('app.reply.sent'));
        }

        return redirect("tickets")->with("message", __('app.cant_do_that'));
    }

    public function show(Reply $reply) : View {

        $redirect = Redirect::find($reply->redirect_id)->first();

        $ticket = Ticket::find($redirect->ticket_id)->first();
        $user = User::find($redirect->user_id)->first();

        return View('replies.show', [
            'reply' => $reply,
            'ticket' => $ticket,
            'user' => $user
        ]);
    }


}
