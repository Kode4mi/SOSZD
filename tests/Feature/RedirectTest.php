<?php

namespace Tests\Feature;

use App\Models\Redirect;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectTest extends TestCase
{
    public function test_redirect_status_auth() : void
    {

        $user = User::factory()->create();
        $ticket = Ticket::factory()->create([
            'sender_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/redirect/'.$ticket->slug);

        $response->assertSuccessful();
        $response->assertViewHas('ticket', $ticket);
        $response->assertViewIs('tickets.redirection');

        $user->delete();
        $ticket->delete();

    }

    public function test_redirect_status_not_auth() : void
    {
        $ticket = Ticket::factory()->create();

        $response = $this->get('/redirect/'.$ticket->id);

        $response->assertStatus(302);
        $response->assertRedirect('/login');

        $ticket->delete();
    }

    public function test_redirect_store_auth() : void
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create([
            'sender_id' => $user->id,
        ]);
        $user_selected = User::factory()->create();

        $response = $this->actingAs($user)->post('/redirect/'.$ticket->slug, ['user_id' => [$user_selected->id]]);

        $response->assertRedirect('/ticket/'.$ticket->slug);
        $response->assertSessionHas('message', __('app.redirected_ticket'));


        $redirect = Redirect::where('ticket_id', $ticket->id)->where('user_id', $user_selected->id)->first();
        $redirect->delete();
        $ticket->delete();
        $user_selected->delete();
        $user->delete();
    }

    public function test_redirect_store_auth_not_valid() : void
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create([
            'sender_id' => $user->id,
        ]);

        $response = $this->from('/redirect/'.$ticket->slug)->actingAs($user)->post('/redirect/'.$ticket->slug);

        $response->assertSessionHasErrors('user_id', 'required');
        $response->assertRedirect('/redirect/'.$ticket->slug);

        $ticket->delete();
    }

    public function test_redirect_store_multiple_auth() : void
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory([
            'sender_id' => $user->id,
        ])->create();
        $user_selected = User::factory()->create();
        $user_selected_2 = User::factory()->create();
        $user_selected_3 = User::factory()->create();
        $user_selected_4 = User::factory()->create();

        $response = $this->actingAs($user)->post('/redirect/'.$ticket->slug, ['user_id' => [$user_selected->id, $user_selected_2->id, $user_selected_3->id, $user_selected_4->id]]);

        $response->assertRedirect('/ticket/'.$ticket->slug);
        $response->assertSessionHas('message', __('app.redirected_ticket'));

        $redirect = Redirect::where('ticket_id', $ticket->id)->where('user_id', $user_selected->id)->first();

        $redirect->delete();
        $ticket->delete();
        $user_selected->delete();
        $user_selected_2->delete();
        $user_selected_3->delete();
        $user_selected_4->delete();
    }

    public function test_redirect_store_not_auth() : void
    {
        $ticket = Ticket::factory()->create();
        $user_selected = User::factory()->create();

        $response = $this->post('/redirect/'.$ticket->id, [$user_selected]);

        $response->assertStatus(302);
        $response->assertRedirect('/login');

        $ticket->delete();
        $user_selected->delete();
    }



}
