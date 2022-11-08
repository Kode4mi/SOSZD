<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_edit_status(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/user/edit');

        $response->assertSuccessful();
        $response->assertViewIs('.user.edit'); // bez kropki wypierdala błąd :)
    }

}
