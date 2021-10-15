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
        $availableUserIds = User::pluck('id')->toArray();
        $availableTopicIds = Topic::pluck('id')->toArray();
        $availableCommentIds = Comment::pluck('id')->toArray();
        $randomUser = DB::table('users')
        ->inRandomOrder()
        ->first();

        $randomUserId = $availableUserIds[array_rand($availableUserIds)];
        $randomTopicId = $availableTopicIds[array_rand($availableTopicIds)];
        $randomCommentId = $availableCommentIds[array_rand($availableCommentIds)];
        return [
            //
        ];
    }
}
