<?php

namespace Database\Factories;

use App\Models\User;
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
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(),
            'slug' => $this->faker->slug(3),
            'body' => $this->faker->paragraph(10),
            'featured' => $this->faker->boolean(20),
            'published_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
