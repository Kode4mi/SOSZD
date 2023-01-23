<?php

namespace Database\Factories;

use App\Models\Redirect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Redirect>
 */
class RedirectFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ticket_id' => $this->faker->numberBetween(1, 20),
            'user_id' => $this->faker->numberBetween(1,6),
            'slug' => md5($this->faker->randomNumber(9, true))
        ];
    }
}
