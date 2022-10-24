<?php

namespace Tests\Feature;

use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketTest extends TestCase
{
    public function test_tickets_status(): void
    {
        $response = $this->get('/tickets');

        $response->assertSuccessful();
        $response->assertViewIs('tickets.index');
    }

    public function test_ticket_status(): void
    {
        $ticket = Ticket::factory()->create();

        $response = $this->get('/ticket/'.$ticket->id);

        $response->assertSuccessful();
        $response->assertViewIs('tickets.show');

        $ticket->delete();
    }

    public function test_ticket_create_status(): void
    {
        $response = $this->get('/ticket/create');

        $response->assertSuccessful();
        $response->assertViewIs('tickets.create');
    }

    public function test_ticket_store() : void
    {
        $ticket = Ticket::factory()->make([
            'temat' => 'Testowy4444'
        ]);

        $response = $this->post('/ticket', $ticket->toArray());

        $response->assertRedirect('/tickets');

        $ticket = Ticket::where('temat', 'Testowy4444');

        $ticket->delete();
    }
}
