<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Feed;
use Faker\Generator as Faker;

$factory->define(Feed::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence()
    ];
});
