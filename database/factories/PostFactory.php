<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'member_id' => $faker->numberBetween(1, 5),
        'post' => $faker->text()
    ];
});
