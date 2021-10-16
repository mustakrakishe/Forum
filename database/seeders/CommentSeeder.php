<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $TOTAL = 5;
        $PER_ITERATION = 1;

        for($i = 0; $i < $TOTAL; $i++){
            Comment::factory($PER_ITERATION)->create();
        }
    }
}
