<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recompenses;
use Faker\Generator as Faker;

$factory->define(Recompenses::class, function (Faker $faker) {
    return [
        'name' => $faker->firstname,
        'year' => $faker->dateTimeAD($max = 'now', $timezone = null),
    ];
});