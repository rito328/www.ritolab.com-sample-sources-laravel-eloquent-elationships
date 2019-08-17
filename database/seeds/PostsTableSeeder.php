<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        /*
        for ($i=1; $i<=10; $i++) {
            $data[] = [
                'member_id' => $i,
                'post' => sprintf('post %s', sprintf('%02d', $i))
            ];
        }
        for ($i=1; $i<=10; $i++) {
            $data[] = [
                'member_id' => $i,
                'post' => sprintf('post %d', ($i + 10))
            ];
        }
        */

        $texts = [
            'hoge', 'fizz', 'buzz'
        ];

        for ($i=1; $i<=30; $i++) {
            $data[] = [
                'member_id' => rand(1, 5),
                'post' => sprintf('post %s %s', sprintf('%02d', $i), $texts[rand(0, 2)])
            ];
        }

        DB::table('posts')->insert($data);
    }
}
