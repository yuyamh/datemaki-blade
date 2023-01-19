<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $levels = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
        $level = $levels[rand(0, count($levels) - 1)];

        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->realText(),
            'level' => $level,
            'user_id' => $this->faker->numberBetween(1, 3),
            'file_name' => $this->faker->word(),

        ];
    }
}
