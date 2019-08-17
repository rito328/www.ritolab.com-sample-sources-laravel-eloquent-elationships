<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $now = date('Y-m-d H:i:s');
        for ($i=1; $i<=30; $i++) {
            $data[] = [
                'post_id' => rand(1, 10),
                'tag_id' => rand(1, 10),
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        DB::table('post_tag')->insert($data);
    }
}
