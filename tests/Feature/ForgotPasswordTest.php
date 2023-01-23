<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    public function test_forget_password_show() : void
    {
        $response = $this->get('/forget-password');

        $response->assertSuccessful();
        $response->assertViewIs('user.forget-password');
    }

    public function test_forget_password_show_when_logged_in() : void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/forget-password');

        $response->assertRedirect('tickets');
    }

    public function test_reset_password_show() : void
    {
        $token = Str::random(64);

        $response = $this->get('/reset-password/'.$token);

        $response->assertSuccessful();
        $response->assertViewIs('user.forget-password-link');
    }

    public function test_reset_password_show_when_logged_in() : void
    {
        $token = Str::random(64);

        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/reset-password/'.$token);

        $response->assertRedirect('tickets');
    }

    public function test_submit_forgot_password() : void
    {
        $user = User::factory()->create();

        $response = $this->post('forget-password', ['email' => $user->email]);

        $passwordReset = DB::table('password_resets')->latest()->first();

        $this->assertNotNull($passwordReset->token);
        $this->assertEquals($passwordReset->email, $user->email);
        $response->assertSessionHas('message', __('passwords.sent'));
        $response->assertRedirect('login');

        $user->delete();
    }

    public function test_submit_reset_password() : void
    {
        $user = User::factory()->create();
        $passwordReset = DB::table('password_resets')->latest()->first();

        $token = $passwordReset->token;

        $password = "new_password".Str::random(10);

        $response = $this->post('reset-password/'.$token, [
            'email' => $user->email,
            'password' => $password,
            'password_confirmation' => $password
        ]);

        $passwordReset = DB::table('password_resets')->latest()->first();

        $this->assertNotNull($passwordReset->token);

        $user->delete();
    }

}
