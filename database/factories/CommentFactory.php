<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomUserId = User::inRandomOrder()->select('id')->first();
        $randomTopicId = User::inRandomOrder()->select('id')->first();
        $randomCommentId = User::inRandomOrder()->select('id')->first();
        return [
            'text' => $this->faker->paragraph(5),
            'author_id' => $randomUserId,
            'topic_id' => $randomTopicId,
            'answer_to_id' => $randomCommentId,
        ];
    }
}
