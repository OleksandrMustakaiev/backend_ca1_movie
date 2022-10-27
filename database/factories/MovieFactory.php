<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() // to create fake information. To run this use seeders "sail artisan db:seed --class=MovieSeeder"
    {
        return [
            'title' => $this->faker->word,
            'year' => $this->faker->numberBetween(2000, 2022),
            'category' => $this->faker->text(50),
            'description' => $this->faker->text(200),
            'rating' => $this->faker->numberBetween(0, 10),
            'image' => $this->faker->word
        ];
    }
}
