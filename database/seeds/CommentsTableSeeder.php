<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'App\Models\Post',
            'App\Models\Feed',
        ];
        $comments = [
            'Post Comment',
            'Feed Comment'
        ];

        $data = [];
        for ($i=0; $i<100; $i++) {
            $comment_type = rand(0, 1);
            $data[] = [
                'member_id' => rand(1, 10),
                'comment' => sprintf('%s %s', $comments[$comment_type], sprintf('%03d', $i) ),
                'commentable_id' => rand(1, 10),
                'commentable_type' => $types[$comment_type]
            ];
        }

        DB::table('comments')->insert($data);
    }
}
