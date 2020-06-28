<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fournisseurs;
use Faker\Generator as Faker;

$factory->define(Fournisseurs::class, function (Faker $faker) {
    return [
        "name" => $faker->company,
        "firstname" => $faker->firstName, 
        "phone" => $faker->phoneNumber,
        "email" => $faker->email,
        "address" => $faker->address,
        "id_users" =>rand(1,5)
    ];
});
