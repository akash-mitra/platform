<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $html = '<p>' . fake()->paragraph(3) . '</p>'
            . '<p>' . fake()->paragraph(3) . '</p>'
            . '<p>' . fake()->paragraph(3) . '</p>';

        return [
            'post_id' => 1,
            'type' => fake()->randomElement(['video', 'image', 'text']),
            'order' => fake()->randomDigit(),
            'markdown' => fake()->paragraph(3),
            'html' => $html,
        ];
    }
}
