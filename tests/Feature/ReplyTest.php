<?php

namespace Tests\Feature;

use App\Models\Redirect;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Generator as Faker;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    public function test_reply_show_status_with_correct_credentials() : void
    {
        $user = User::factory()->create();
        $redirect = Redirect::factory()->create([
            'user_id' => $user->id,
        ]);
        $reply = Reply::factory()->create([
            'redirect_id' => $redirect->id,
        ]);

        $response = $this->actingAs($user)->get("reply/".$reply->slug);

        $response->assertSuccessful();
        $response->assertViewIs('replies.show');

        $user->delete();
        $reply->delete();
        $redirect->delete();
    }

    public function test_reply_show_status_with_incorrect_credentials() : void
    {
        $user = User::factory()->make();
        $redirect = Redirect::factory()->create([
            'user_id' => 1,
        ]);
        $reply = Reply::factory()->create([
            'redirect_id' => $redirect->id,
        ]);

        $response = $this->actingAs($user)->get("reply/".$reply->slug);

        $response->assertRedirect('tickets');
        $response->assertSessionHas('message', __("app.access_denied"));

        $reply->delete();
        $redirect->delete();
    }

    public function test_reply_create_status_with_correct_credentials() : void
    {
        $user = User::factory()->create();
        $redirect = Redirect::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get("reply/create/".$redirect->slug);

        $response->assertSuccessful();
        $response->assertViewIs('replies.create');

        $user->delete();
        $redirect->delete();
    }

    public function test_reply_create_status_with_incorrect_credentials() : void
    {
        $user = User::factory()->make();
        $redirect = Redirect::factory()->create([
            'user_id' => 1,
        ]);

        $response = $this->actingAs($user)->get("reply/create/".$redirect->slug);

        $response->assertRedirect('tickets');
        $response->assertSessionHas('message', __('app.cant_do_that'));

        $redirect->delete();
    }

    public function test_reply_create_status_when_already_replayed() : void
    {
        $user = User::factory()->create();
        $redirect = Redirect::factory()->create([
            'user_id' => $user->id,
        ]);
        $reply = Reply::factory()->create([
            'redirect_id' => $redirect->id
        ]);

        $response = $this->actingAs($user)->get("reply/create/".$redirect->slug);

        $response->assertRedirect('tickets');
        $response->assertSessionHas('message', __('app.cant_do_that'));

        $user->delete();
        $redirect->delete();
    }

    public function test_reply_store_with_correct_credentials() : void
    {
        $user = User::factory()->create();
        $redirect = Redirect::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->post("reply/".$redirect->slug, ['message' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque viverra, mauris id porttitor iaculis, mauris lectus maximus velit, vitae dapibus sem est vel dui. Etiam sit amet sem vulputate, pulvinar erat et, fringilla tortor. Phasellus egestas vitae tortor in fringilla. Proin ac odio facilisis, varius odio in, interdum arcu."]);

        $response->assertRedirect('tickets');
        $response->assertSessionHas('message', __('app.reply.sent'));

        $user->delete();
        $redirect->delete();
    }

    public function test_reply_store_with_incorrect_credentials() : void
    {
        $user = User::factory()->create();
        $redirect = Redirect::factory()->create([
            'user_id' => 1,
        ]);

        $response = $this->actingAs($user)->post("reply/".$redirect->slug, ['message' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque viverra, mauris id porttitor iaculis, mauris lectus maximus velit, vitae dapibus sem est vel dui. Etiam sit amet sem vulputate, pulvinar erat et, fringilla tortor. Phasellus egestas vitae tortor in fringilla. Proin ac odio facilisis, varius odio in, interdum arcu."]);

        $response->assertRedirect('tickets');
        $response->assertSessionHas('message', __('app.cant_do_that'));

        $user->delete();
        $redirect->delete();
    }

}
