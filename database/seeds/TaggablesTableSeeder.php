<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaggablesTableSeeder extends Seeder
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

        $data = [];
        for ($i=0; $i<100; $i++) {
            $tag_type = rand(0, 1);
            $data[] = [
                'tag_id' => rand(1, 10),
                'taggable_id' => rand(1, 20),
                'taggable_type' => $types[$tag_type]
            ];
        }

        DB::table('taggables')->insert($data);
    }
}
