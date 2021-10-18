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
        $randomAuthorId = User::inRandomOrder()->first()->id;

        $randomDate = $this->faker->dateTimeBetween(
            $startDate = '-1 year',
            $endDate = 'now',
            $timezone = config('app.timezone')
        );

        $randomParrentComment = $this->faker->boolean(75)
            ? Comment::inRandomOrder()->first()
            : null;
        
        [$answerToId, $topicId] = $randomParrentComment
            ? [$randomParrentComment->id, $randomParrentComment->topic_id]
            : [null, Topic::inRandomOrder()->first()->id];

        return [
            'text' => $this->faker->paragraph(5),
            'author_id' => $randomAuthorId,
            'topic_id' => $topicId,
            'answer_to_id' => $answerToId,
            'created_at' => $randomDate,
        ];
    }
}
