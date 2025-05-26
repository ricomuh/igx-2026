<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            // 'slug' => fake()->unique()->slug(),
            'image_url' => asset('dummies/guest' . fake()->numberBetween(1, 7) . '.webp'),
            'url' => fake()->optional()->url(),
        ];
    }
}
