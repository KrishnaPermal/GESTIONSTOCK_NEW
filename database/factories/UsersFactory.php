<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Users;
use Faker\Generator as Faker;

$factory->define(Users::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'firstname' => $faker->firstname,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'ioezo59aeaœ:zmzra',
        'id_role' => 1,
    ];
});