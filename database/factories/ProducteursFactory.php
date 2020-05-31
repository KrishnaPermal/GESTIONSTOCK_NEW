<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Producteurs;
use Faker\Generator as Faker;

$factory->define(Producteurs::class, function (Faker $faker) {
    return [
        "name" => $faker->lastname,
        "id_users" =>rand(1,5)
    ];
});
