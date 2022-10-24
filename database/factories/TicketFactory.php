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
    #[ArrayShape(['temat' => "string", 'opis' => "string", 'termin' => "string", 'priorytet' => "int"])]
    public function definition(): array
    {
        return [
            'temat' => $this->faker->title,
            'opis' => $this->faker->sentence,
            'termin' => date("Y-m-d H:i:s", strtotime('+1 day')),
            'priorytet' => $this->faker->numberBetween(1,4),
        ];
    }
}
