<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'temat' => $this->faker->title,
            'opis' => $this->faker->sentence,
            'termin' => date("Y-m-d H:i:s", strtotime('+1 day', time())),
            'priorytet' => $this->faker->numberBetween(1,4),
        ];
    }
}
