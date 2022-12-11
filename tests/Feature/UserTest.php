<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    /*
        Do zrobienia:

        update - na później
        update_pass
        create
    */

    /*
        done:

        auth
        edit
        edit_pass
        index
        login
        logout

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

    public function test_user_logout_status(): void
    {
        $user = User::factory()->create([
            'first_name' => "Kunegunda",
            'role' => 'admin'
        ]);

        $response = $this->actingAs($user)->post('/logout');
        $response->assertRedirect('login');
        $this->assertGuest();
        $user->delete();
    }

    // czy to wgl jest potrzebne????
    public function test_user_logout_status_not_auth(): void{

        $response = $this->post('/logout');
        $response->assertRedirect('login');
        $this->assertGuest();
    }

    public function test_user_register_status_for_admin(): void{

        $user = User::factory()->create([
            'first_name' => "Kunegunda",
            'role' => 'admin'
        ]);

        $response = $this->actingAs($user)->get('/user/register');
        $response->assertViewIs('user.create');

        $user->delete();
    }

    public function test_user_register_status_for_user(): void {

        $user = User::factory()->make([
            'first_name' => "Kunegunda",
            'role' => 'nauczyciel'
        ]);

        $response = $this->actingAs($user)->get('/user/register');

        $response->assertRedirect('/');

    }

    public function test_user_register_status_not_auth(): void{

        $response = $this->get('/user/register');
        $response->assertRedirect('login');
    }


    // tu nie rozumiem do końca

    public function test_user_store(): void{

        $user = User::factory()->create([
            'first_name' => "Kunegunda",
            'role' => 'admin'
        ]);

        $user2 = User::factory()->make();

        $response = $this->actingAs($user)->post('/user', $user2->toArray());

         $response->assertRedirect('/users');
        $response->assertSessionHasNoErrors();

        $user->delete();
        $user2->delete();
    }

    public function test_user_store_not_auth(): void{

        $user2 = User::factory()->make();

        $response = $this->post('/user', $user2->toArray());

        $response->assertRedirect('login');

        $user2->delete();
    }

}
