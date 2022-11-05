<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketTest extends TestCase
{
    public function test_tickets_status(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/tickets');

        $response->assertSuccessful();
        $response->assertViewIs('tickets.index');
    }

    public function test_ticket_status(): void
    {
        $user = User::factory()->make();

        $ticket = Ticket::factory()->create();

        $response = $this->actingAs($user)->get('/ticket/'.$ticket->id);

        $response->assertSuccessful();
        $response->assertViewIs('tickets.show');

        $ticket->delete();
    }

    public function test_ticket_create_status(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/ticket/create');

        $response->assertSuccessful();
        $response->assertViewIs('tickets.create');
    }

    public function test_ticket_store() : void
    {
        $user = User::factory()->make();

        $ticket = Ticket::factory()->make([
            'title' => 'Testowy4444'
        ]);

        $response = $this->actingAs($user)->post('/ticket', $ticket->toArray());

        $response->assertRedirect('/tickets');

        $ticket = Ticket::where('title', 'Testowy4444');

        $ticket->delete();
    }
}
