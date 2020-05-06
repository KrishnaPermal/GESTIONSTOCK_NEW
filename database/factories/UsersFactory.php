<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'nom' => $faker->lastname,
        'prenom' => $faker->firstname,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'ioezo59aeaœ:zmzra', // password
        'id_role' => 2,
    ];
});