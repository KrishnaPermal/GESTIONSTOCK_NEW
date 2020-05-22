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
                "photo" => "/storage/images/test1.jpg",

            ],
            [
                "id" => 2,
                "photo" => "/storage/images/test2.jpeg",
            ],
            [
                "id" => 3,
                "photo" => "/storage/images/test3.jpeg",
            ],

            [
                "id" => 4,
                "photo" => "/storage/images/test4.png",
            ],
            
        ];

        DB::table('photos')->insert(
            $array
        );
    }
}
