<?php

namespace Tests\Feature;

use App\Models\Redirect;
use App\Models\Ticket;
use App\Models\User;
use Tests\TestCase;

class TicketTest extends TestCase
{
    public function test_tickets_status(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/tickets');

        $response->assertSuccessful();
        $response->assertViewHas('title', "Aktualne sprawy");
        $response->assertViewHas('form', "archive");
        $response->assertViewIs('tickets.index');
    }

    public function test_tickets_status_not_auth(): void
    {
        $response = $this->get('/tickets');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_ticket_status(): void
    {
        $user = User::factory()->create();

        $ticket = Ticket::factory()->create();

        $redirect = Redirect::factory()->create([
           'ticket_id' => $ticket->id,
           'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/ticket/'.$ticket->slug);

        $response->assertSuccessful();

        $response->assertViewIs("tickets.show");

        $user->delete();
        $ticket->delete();
        $redirect->delete();
    }


    public function test_ticket_status_when_not_in_ticket(): void
    {
        $user = User::factory()->make();

        $ticket = Ticket::factory()->create();

        $response = $this->actingAs($user)->get('/ticket/'.$ticket->slug);

        $response->assertRedirect("/tickets");

        $response->assertSessionHas("message", "Nie można odczytać tej sprawy!");

        $ticket->delete();
    }

    public function test_ticket_status_not_auth(): void
    {
        $ticket = Ticket::factory()->create();

        $response = $this->get('/ticket/'.$ticket->id);

        $response->assertRedirect('login');

        $ticket->delete();
    }

    public function test_ticket_create_status(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/ticket/create');

        $response->assertSuccessful();
        $response->assertViewIs('tickets.create');
    }

    public function test_ticket_create_status_not_auth(): void
    {
        $response = $this->get('/ticket/create');

        $response->assertRedirect('login');
    }

    public function test_ticket_store() : void
    {
        $user = User::factory()->create([
            'first_name' => "Kunegunda"
        ]);

        $ticket = Ticket::factory()->make([
            'title' => 'Testowy4444',
        ]);

        $response = $this->actingAs($user)->post('/ticket', $ticket->toArray());

//        $response->assertRedirect("/ticket/".$ticket->id);
        $response->assertSessionHasNoErrors();

        $ticket->delete();
        $user->delete();
    }

    public function test_ticket_store_not_auth() : void
    {
        $ticket = Ticket::factory()->make([
            'title' => 'Testowy4444'
        ]);

        $response = $this->post('/ticket', $ticket->toArray());

        $response->assertRedirect('login');
    }
}
