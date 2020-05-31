<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Users;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        //'firstname' => $faker->firstname,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'ioezo59aeaœ:zmzra',
        'id_role' => rand(1,3)
    ];
});