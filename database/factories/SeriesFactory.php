<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Series>
 */
class SeriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(3);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(3),
            'is_featured' => fake()->boolean(),
            'image_url' => fake()->imageUrl(),
            'thumbnail_url' => fake()->imageUrl(),
            'level' => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
        ];
    }
}
