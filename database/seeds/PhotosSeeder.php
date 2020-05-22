<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            [
                "id" => 1,
                "photo" => "https://www.chaletmodele-comte.com/photos/produit-66-86.jpg",
                
                //"photo" => "/public/storage/images/test.jpeg",

            ],
            [
                "id" => 2,
                "photo" => "https://www.confiture-songeduverger.com/Files/122474/Img/02/mini-pots-accueil-confitures-1.png",
               
                //"photo" => "/public/storage/images/test2.jpeg",
            ],
            [
                "id" => 3,
                "photo" => "https://cdn.radiofrance.fr/s3/cruiser-production/2019/03/ee5e0778-7fb7-4b1b-9dbb-23e605c35df1/870x489_img_20190305_175205.jpg",
              
                //"photo" => "/public/storage/images/test2.jpeg",
            ],
            
        ];

        DB::table('photos')->insert(
            $array
        );
    }
}
