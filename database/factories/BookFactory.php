<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'author_id' => Author::factory(),
            'user_id' => User::factory(),
            'year' => fake()->numberBetween(1900, 2025),
            'price' => fake()->randomFloat(2, 5, 100),
        ];
    }
}
