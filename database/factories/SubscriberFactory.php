<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscriber>
 */
class SubscriberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_ids = $this->faker->randomElement(User::pluck('id')->toArray());

        return [
            'user_id' => $user_ids,
            'website_id' => $this->faker->unique()->numberBetween(1, 20),
            'email' => $this->faker->email,
        ];
    }
}
