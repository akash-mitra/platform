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
        $sampleYouTubeVideos = collect([
            '7UfM7Lkw4U4', 'jfKfPfyJRdk', '6WZ67f9M3RE', '4bIX8HsLm9c', '_Gu_gnT2FAY'
        ]);

        $booleans = collect([true, true, true, true, false]);

        return [
            'title' => fake()->sentence(7),
            'about' => fake()->paragraph(4),
            'order' => fake()->randomDigit(),
            'image_url' => 'https://picsum.photos/300/200?random=' . fake()->randomDigit(),
            'thumbnail_url' => 'https://picsum.photos/200?random=' . fake()->randomDigit(),
            'video_url' => 'https://www.youtube.com/embed/' . $sampleYouTubeVideos->random(),
            'youtube_video_id' => $sampleYouTubeVideos->random(),
            'duration' => fake()->randomDigit(),
            'likes' => fake()->randomDigit(),
            'is_published' => $booleans->random(),
            'is_featured' => ! $booleans->random(),
            'is_premium' => ! $booleans->random(),
            'subject_id' => 1,
            'user_id' => 1
        ];
    }
}
