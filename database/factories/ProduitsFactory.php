<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Producteurs;
use App\Produits;
use Faker\Generator as Faker;

$factory->define(Produits::class, function (Faker $faker) {

    $id_producteurs = Producteurs::all();
    $id_producteur = $faker->randomElement($id_producteurs)->id;

    return [
        "name" => $faker->firstName,
        "quantity" => $faker->numberBetween($min = 3, $max = 800),
        "price" => $faker->numberBetween($min = 3, $max = 100),
        "id_producteur" => $id_producteur,
        "photo" => '/storage/images/test2.jpeg',
        //"id_producteur" => factory(Producteurs::class),
        //"id_photo" => PhotosModel::all()->random()->id,
    ];
});
