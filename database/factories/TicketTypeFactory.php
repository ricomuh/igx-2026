<?php

namespace Database\Factories;

use App\Models\TicketType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TicketTypeFactory extends Factory
{
    protected $model = TicketType::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'description' => 'Akses satu hari penuh.',
            'price' => 75000,
            'capacity' => null,
            'is_active' => true,
            'sort' => 0,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['is_active' => false]);
    }

    public function limited(int $capacity): static
    {
        return $this->state(fn () => ['capacity' => $capacity]);
    }
}
