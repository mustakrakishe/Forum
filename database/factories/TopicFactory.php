<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Topic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomUser = User::inRandomOrder()->first();

        return [
            'title' => $this->faker->text(20),
            'content' => $this->faker->paragraphs(5, true),
            'user_id' => $randomUser->id,
        ];
    }
}
