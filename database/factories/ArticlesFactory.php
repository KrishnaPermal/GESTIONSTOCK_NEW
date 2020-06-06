<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articles;
use App\Fournisseurs;
use Faker\Generator as Faker;

$factory->define(Articles::class, function (Faker $faker) {

    $id_fournisseurs = Fournisseurs::all();
    $id_fournisseur = $faker->randomElement($id_fournisseurs)->id;

    return [
        "article_ref" => $faker->ean8,
        "mark" => $faker->word,
        "description" => $faker->word,
        "provider" => $faker->firstNameMale,
        "quantity" => $faker->numberBetween($min = 3, $max = 800),
        "price" => $faker->numberBetween($min = 3, $max = 100),
        "id_fournisseur" => $id_fournisseur,
        //"photo" => '/storage/images/test2.jpeg',
        //"id_producteur" => factory(Producteurs::class),
        //"id_photo" => PhotosModel::all()->random()->id,
    ];
});
