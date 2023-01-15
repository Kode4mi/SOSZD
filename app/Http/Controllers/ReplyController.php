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
    public function create(String $slug): RedirectResponse|View
    {
        $redirect = Redirect::where('slug', $slug)->first();

        /** @var User $user */
        $user = auth()->user();

        if ((!$redirect->hasReply() && $user->id === $redirect->user_id) || $user->role === "admin") {
            return View('replies.create', [
                'redirect' => $redirect,
                'ticket' => Ticket::find($redirect->ticket_id),
            ]);
        }
        return redirect('tickets')->with('message', __('app.cant_do_that'));
    }

    public function store(Request $request, String $slug): RedirectResponse
    {
        $redirect = Redirect::where('slug', $slug)->first();

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

            $formFields += ['slug'=> 'placeholder'];
            $redirect = Reply::create($formFields);

            $slug = md5($redirect->id."-".$redirect->redirect_id);

            $redirect->update(['slug' => $slug]);

            return redirect("tickets")->with("message", __('app.reply.sent'));
        }

        return redirect("tickets")->with("message", __('app.cant_do_that'));
    }

    public function show(String $slug): View|RedirectResponse
    {

        $reply = Reply::where('slug', $slug)->first();

        $redirect = Redirect::where("id", $reply->redirect_id)->first();

        $ticket = Ticket::where("id", $redirect->ticket_id)->first();

        $auth_user = auth()->user()->id;

        if($ticket->sender_id === $auth_user || $redirect->user_id === $auth_user) {
            $user = User::where('id', $redirect->user_id)->first();

            return View('replies.show', [
                'reply' => $reply,
                'ticket' => $ticket,
                'user' => $user
            ]);
        }

        return redirect("tickets")->with('message', __("app.access_denied"));
    }


}
