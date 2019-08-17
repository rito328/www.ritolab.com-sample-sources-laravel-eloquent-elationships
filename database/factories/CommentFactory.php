<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $types = [
        'App\Models\Post',
        'App\Models\Feed',
    ];
    return [
        'member_id' => $faker->numberBetween(1, 10),
        'comment' => $faker->sentence,
        'commentable_id' => $faker->numberBetween(1, 10),
        'commentable_type' => $types[$faker->numberBetween(0, 1)]
    ];
});
