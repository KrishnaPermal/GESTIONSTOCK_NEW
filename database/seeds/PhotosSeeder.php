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
                "photo" => "/storage/imgs/test.jpeg",

            ],
            [
                "id" => 2,
                "photo" => "/storage/imgs/test2.jpeg",
            ],
        ];

        DB::table('photos')->insert(
            $array
        );
    }
}
