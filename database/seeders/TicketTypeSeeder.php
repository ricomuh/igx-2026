<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Placeholder ticket types (prices match the design reference).
     * Prices/final types to be confirmed before Midtrans goes live.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Regular',
                'slug' => 'regular',
                'description' => 'Ticket only for Day 1 or Day 2',
                'price' => 100000,
                'sort' => 1,
            ],
            [
                'name' => 'IGX Merchandise',
                'slug' => 'igx-merchandise',
                'description' => 'Ticket + Bundling 1 Merchandise (Exclusive IGX Merchandise)',
                'price' => 500000,
                'sort' => 2,
            ],
        ];

        foreach ($types as $type) {
            TicketType::updateOrCreate(
                ['slug' => $type['slug']],
                array_merge($type, ['is_active' => true, 'capacity' => null]),
            );
        }
    }
}
