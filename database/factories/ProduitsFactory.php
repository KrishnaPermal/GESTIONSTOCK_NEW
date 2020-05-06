<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Producteurs;
use App\Produits;
use Faker\Generator as Faker;

$factory->define(Produits::class, function (Faker $faker) {

    return [
        "name" => $faker->firstName,
        "quantity" => $faker->numberBetween($min = 10, $max = 15),
        "price" => $faker->numberBetween($min = 10, $max = 15),
        "id_producteur" => factory(Producteurs::class)
    ];
});
