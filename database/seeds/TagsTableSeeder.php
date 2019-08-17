<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $data = [];
        for ($i=1; $i<=10; $i++) {
            $data[] = [
                'tag' => sprintf('tag %s', sprintf('%02d', $i)),
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        DB::table('tags')->insert($data);
    }
}
