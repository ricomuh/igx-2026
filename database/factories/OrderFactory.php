<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'order_number' => 'IGX-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
            'customer_name' => fake()->name(),
            'customer_email' => fake()->safeEmail(),
            'customer_phone' => '08' . fake()->numerify('##########'),
            'total_amount' => 0,
            'status' => Order::STATUS_PENDING,
            'payment_method' => 'transfer',
        ];
    }
}
