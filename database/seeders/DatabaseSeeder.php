<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        Post::factory(200)->create([
            'user_id' => 1,
            'created_at' => now()->subDays(rand(1, 30)),
        ])->each(
            function ($post) {
                for ($i = 0; $i < rand(1, 10); $i++) {
                    $post->views()->create([
                        'views' => rand(1, 100),
                        'date' => now()->subDays(rand(1, 30)),
                    ]);
                }
            }
        );

        $this->call([
            GuestSeeder::class,
            ExhibitorSeeder::class,
        ]);
    }
}
