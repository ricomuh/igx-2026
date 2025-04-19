<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new \Mmo\Faker\PicsumProvider($this->faker));
        return [
            'title' => $this->faker->sentence,
            'body' => $this->generateHtmlBody(),
            'slug' => fn($table) => str($table['title'])->slug(),
            'image_url' => $this->faker->picsumUrl(800, 600),
            'user_id' => 1,
        ];
    }

    /**
     * Generate an HTML body with 3 sections.
     *
     * @return string
     */
    private function generateHtmlBody(): string
    {
        $html = '';
        for ($i = 1; $i <= 3; $i++) {
            $html .= "<section>";
            $html .= "<h2>Section {$i}</h2>";
            $html .= "<p>" . $this->faker->paragraph . "</p>";
            $html .= "<p>" . $this->faker->paragraph . "</p>";
            $html .= "</section>";
        }
        return $html;
    }
}
