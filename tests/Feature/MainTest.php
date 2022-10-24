<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MainTest extends TestCase
{

    public function test_main_route_redirect() : void
    {
        $response = $this->get('/');

        $response->assertRedirect('/tickets');
    }

}
