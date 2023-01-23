<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class ReplyFactory extends Factory
{
    public function definition() : array
    {
        return [
            'redirect_id' => $this->faker->numberBetween(1, 4),
            'message' => $this->faker->sentence,
            'slug' => md5($this->faker->randomNumber(9, true)),
        ];
    }
}
