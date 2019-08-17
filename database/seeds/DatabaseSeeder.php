<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MembersTableSeeder::class,
            PhonesTableSeeder::class,
            CommentsTableSeeder::class,
            PostsTableSeeder::class,
            TagsTableSeeder::class,
            PostTagTableSeeder::class,
            RolesTableSeeder::class,
            FeedsTableSeeder::class,
            TaggablesTableSeeder::class,
        ]);
    }
}
