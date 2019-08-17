<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for ($i=1; $i<=10; $i++) {
            $data[] = [
                'member_id' => $i,
                'number' => sprintf('090000000%s', sprintf('%02d', $i))
            ];
        }
        DB::table('phones')->insert($data);
    }
}
