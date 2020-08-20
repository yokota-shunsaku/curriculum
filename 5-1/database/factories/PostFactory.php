<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(2,11),
                'body' => $faker->realText($maxNbChars = 20),
                'created_at' => $faker->dateTimeThisYear,
                'updated_at' => $faker->dateTimeThisMonth
    ];
});
