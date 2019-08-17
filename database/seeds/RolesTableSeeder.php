<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name' => 'Role01' ],
            [ 'name' => 'Role02' ],
            [ 'name' => 'Role03' ],
            [ 'name' => 'Role04' ],
            [ 'name' => 'Role05' ],
            [ 'name' => 'Role06' ],
            [ 'name' => 'Role07' ],
            [ 'name' => 'Role08' ],
            [ 'name' => 'Role09' ],
            [ 'name' => 'Role10' ],
        ];

        DB::table('roles')->insert($data);
    }
}
