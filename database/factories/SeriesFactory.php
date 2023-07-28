<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Series>
 */
class SeriesFactory extends Factory
{
    public $images = [
        'https://images.unsplash.com/photo-1542831371-29b0f74f9713?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0Nzg1MzZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTAwMzYyMDl8&ixlib=rb-4.0.3&q=80&w=1080',
        'https://images.unsplash.com/photo-1598970434795-0c54fe7c0648?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0Nzg1MzZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTAwMzYyMDl8&ixlib=rb-4.0.3&q=80&w=1080',
        'https://images.unsplash.com/photo-1542831371-32f555c86880?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0Nzg1MzZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTAwMzYyMDl8&ixlib=rb-4.0.3&q=80&w=1080',
        'https://images.unsplash.com/photo-1542762933-ab3502717ce7?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0Nzg1MzZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTAwMzYyMDl8&ixlib=rb-4.0.3&q=80&w=1080',
        'https://images.unsplash.com/photo-1582845512747-e42001c95638?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0Nzg1MzZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTAwMzYyMDl8&ixlib=rb-4.0.3&q=80&w=1080',
        'https://images.unsplash.com/photo-1627399270231-7d36245355a9?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0Nzg1MzZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTAwMzYyMDl8&ixlib=rb-4.0.3&q=80&w=1080',
        'https://images.unsplash.com/photo-1618171889969-0feeb769fe78?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0Nzg1MzZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTAwMzYyMDl8&ixlib=rb-4.0.3&q=80&w=1080',
        'https://images.unsplash.com/photo-1624953587687-daf255b6b80a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0Nzg1MzZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTAwMzYyMDl8&ixlib=rb-4.0.3&q=80&w=1080',
        'https://images.unsplash.com/photo-1571171637578-41bc2dd41cd2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0Nzg1MzZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTAwMzYyMDl8&ixlib=rb-4.0.3&q=80&w=1080',
        'https://images.unsplash.com/photo-1453060113865-968cea1ad53a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0Nzg1MzZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTAwMzYyMDl8&ixlib=rb-4.0.3&q=80&w=1080',
    ];

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
            'image_url' => $this->images[fake()->numberBetween(0, count($this->images) - 1)],
            'thumbnail_url' => fake()->imageUrl(),
            'level' => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
        ];
    }
}
