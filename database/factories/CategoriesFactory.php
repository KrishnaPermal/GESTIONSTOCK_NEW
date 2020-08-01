<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categories;
use Faker\Generator as Faker;

$factory->define(Categories::class, function (Faker $faker) {
    return [
        //"name" => $faker->lastname,
        "name" => $faker->randomElement($array = array ('Carte mère','Barette mémoire','Disque dur','Carte graphique','PC Portable','Ecran','PC de Bureau')) // 'b'
    ];
});
