<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post_status_id' => $faker->numberBetween(1, 3),
        'title' => $faker->realText($faker->numberBetween(10, 20)),
        'content' => $faker->realText($faker->numberBetween(10, 100)),
        'posted_at' => rand(strtotime('2019-01-01'), time()),
    ];
});
