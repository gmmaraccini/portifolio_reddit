<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = fake()->sentence();

        return [
            // Cria um user novo se não passarmos um
            'user_id' => \App\Models\User::factory(),
            'title' => $title,
            // Transforma "Olá Mundo" em "ola-mundo"
            'slug' => Str::slug($title) . '-' . rand(1, 1000),
            'body' => fake()->paragraphs(3, true),
        ];
    }
}
