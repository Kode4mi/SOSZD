<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\User;
use Tests\TestCase;

class ArchiveTest extends TestCase
{
    public function test_archives_status(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/archives');

        $response->assertSuccessful();
        $response->assertViewHas('title', "Zarchiwizowane sprawy");
        $response->assertViewHas('form', "unarchive");
        $response->assertViewIs('tickets.index');
    }

    public function test_archive_auth(): void
    {
        $user = User::factory()->make();
        $ticket = Ticket::factory()->create();

        $response = $this->from('/tickets')->actingAs($user)->put('/archive', ['id' => ['id' => $ticket->id]]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/tickets');

        $ticket->delete();
    }

    public function test_archive_multiple_auth(): void
    {
        $user = User::factory()->make();
        $ticket1 = Ticket::factory()->create();
        $ticket2 = Ticket::factory()->create();

        $response = $this->from('/tickets')->actingAs($user)->put('/archive', [
            'id' => [0 => $ticket1->id, 1 => $ticket2->id],
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/tickets');

        $ticket1->delete();
        $ticket2->delete();
    }

    public function test_archive_no_id_auth(): void
    {
        $user = User::factory()->make();

        $response = $this->from('/tickets')->actingAs($user)->put('/archive');

        $response->assertSessionHasErrors('id', 'required');
        $response->assertRedirect('/tickets');
    }

    public function test_archive_not_auth(): void
    {
        $ticket = Ticket::factory()->create();

        $response = $this->from('/tickets')->put('/archive', ['id' => ['id' => $ticket->id]]);

        $response->assertRedirect('/login');

        $ticket->delete();
    }

    public function test_unarchive_auth(): void
    {
        $user = User::factory()->make();
        $ticket = Ticket::factory()->create([
            'active' => 0,
        ]);

        $response = $this->from('/archives')->actingAs($user)->put('/unarchive', ['id' => ['id' => $ticket->id]]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/archives');

        $ticket->delete();
    }

    public function test_unarchive_multiple_auth(): void
    {
        $user = User::factory()->make();
        $ticket1 = Ticket::factory()->create([
            'active' => 0,
        ]);
        $ticket2 = Ticket::factory()->create([
            'active' => 0,
        ]);

        $response = $this->from('/archives')->actingAs($user)->put('/unarchive', [
            'id' => [0 => $ticket1->id, 1 => $ticket2->id],

        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/archives');

        $ticket1->delete();
        $ticket2->delete();
    }

    public function test_unarchive_no_id_auth(): void
    {
        $user = User::factory()->make();

        $response = $this->from('/archives')->actingAs($user)->put('/unarchive');

        $response->assertSessionHasErrors('id', 'required');
        $response->assertRedirect('/archives');
    }

    public function test_unarchive_not_auth(): void
    {
        $ticket = Ticket::factory()->create([
            'active' => 0,
        ]);

        $response = $this->from('/archives')->put('/unarchive', ['id' => ['id' => $ticket->id]]);

        $response->assertRedirect('/login');

        $ticket->delete();
    }

}
