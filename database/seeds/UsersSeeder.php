<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
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
                "name" => "Krishna PERMALNAÏKEN",
                //"firstname" => "Krishna",
                "email" => "krishnapermalnaiken@gmail.com",
                "password" => bcrypt('admin'),
                "id_role" => "1"

            ],
            [
                "id" => 2,
                "name" => "Alexander MILLER",
                "email" => "alexandermiller@gmail.com",
                "password" => bcrypt('client'),
                "id_role" => "2"

            ],
            [
                "id" => 3,
                "name" => "Joe GARCIA",
                "email" => "joegarcia@gmail.com",
                "password" => bcrypt('fournisseur'),
                "id_role" => "3"

            ],
            [
                "id" => 4,
                "name" => "Waren ROBINSON",
                "email" => "warenrobinson@gmail.com",
                "password" => bcrypt('client'),
                "id_role" => "2"

            ],
            [
                "id" => 5,
                "name" => "Kyle LOPEZ ",
                "email" => "kylelopez@gmail.com",
                "password" => bcrypt('client'),
                "id_role" => "2"

            ],
        ];

        DB::table('users')->insert(
            $array
        );
        factory(User::class, 3)->create();
    }
}
