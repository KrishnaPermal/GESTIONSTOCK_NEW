<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PhotosModel;
use App\Producteurs;
use App\Produits;
use Faker\Generator as Faker;

$factory->define(Produits::class, function (Faker $faker) {

    $id_producteurs = Producteurs::all();
    $id_producteur = $faker->randomElement($id_producteurs)->id;

    $id_photos = PhotosModel::all();
    $id_photo = $faker->randomElement($id_photos)->id;

    return [
        "name" => $faker->firstName,
        "quantity" => $faker->numberBetween($min = 3, $max = 800),
        "price" => $faker->numberBetween($min = 3, $max = 100),
        "id_producteur" => $id_producteur,
        "id_photo" => $id_photo,
        //"id_producteur" => factory(Producteurs::class),
        //"id_photo" => PhotosModel::all()->random()->id,
    ];
});
