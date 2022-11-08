<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['title' => "string", 'description' => "string", 'deadline' => "string", 'priority' => "int", "sender_id" => "int"])]
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'deadline' => date("Y-m-d H:i:s", strtotime('+1 day')),
            'priority' => $this->faker->numberBetween(1,4),
            'sender_id' => 1,
        ];
    }
}
