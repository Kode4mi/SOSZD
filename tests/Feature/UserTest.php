<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /*
        Do zrobienia:

        login 
        authenticate
        logout
        update - na późńiej
        update_pass
    */


    public function test_user_edit_status(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/user/edit');

        $response->assertSuccessful();
        $response->assertViewIs('user.edit'); // bez kropki wypierdala błąd :)
    }

    public function test_user_edit_status_not_auth(): void
    {
        $response = $this->get('/user/edit');

        $response->assertRedirect('login');
    }

    public function test_user_editPassword_status(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/change-password');

        $response->assertSuccessful();
        $response->assertViewIs('user.password-change');
    }
    public function test_user_editPassword_status_not_auth(): void
    {
        $response = $this->get('/change-password');

        $response->assertRedirect('login');
    }

    public function test_user_index_status(): void
    {
        $user = User::factory()->create([
            'first_name' => "Kunegunda",
            'role' => 'admin'
        ]);

        $response = $this->actingAs($user)->get('/users');

        $response->assertSuccessful();
        $response->assertViewIs('user.index','');
        $user->delete();
    }
    public function test_user_index_status_not_auth(): void
    {
        $response = $this->get('/users');

        $response->assertRedirect('login');
    }

    public function test_user_authenticate_status(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login',[
            'email' => $user->email,
            'password' => 'password',
        ]);
        
        // albo z emailem albo z hasłem jest coś zjebane, bo jakby nie logowało 

        $response->assertRedirect('tickets');
        $user->delete();
    }

    public function test_user_authenticate_status_wrong_pass(): void
    {
        $response = $this->post('/login',[
            'email' => 'twojstary@soszd.pl',
            'password' => "2"
        ]);
        
        // albo z emailem albo z hasłem jest coś zjebane - tu to wogóle szkoda strzępić ryja

        $response->assertRedirect('login');
    }

}
