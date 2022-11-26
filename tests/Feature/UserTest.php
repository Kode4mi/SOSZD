<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /*
        Do zrobienia:

        login
        logout
        update - na później
        update_pass
        create
    */


    public function test_user_edit_status(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/user/edit');

        $response->assertSuccessful();
        $response->assertViewIs('user.edit');
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
        $response->assertViewIs('user.index');
        $user->delete();
    }
    public function test_user_index_status_not_auth(): void
    {
        $response = $this->get('/users');

        $response->assertRedirect('login');
    }

    public function test_user_authenticate_status(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password-butter'),
        ]);

        $response = $this->post('/users/authenticate', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/tickets');
        $this->assertAuthenticatedAs($user);
        $user->delete();
    }

    public function test_user_authenticate_status_wrong_pass(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password-butter'),
        ]);

        $response = $this->from('/login')->post('/users/authenticate', [
            'email' => $user->email,
            'password' => 'bad-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
        $user->delete();
    }

}
