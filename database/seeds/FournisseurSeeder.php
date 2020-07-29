<?php

use App\Articles;
use App\Categories;
use App\Fournisseurs;
use Illuminate\Database\Seeder;

class FournisseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Categories::class, 4)->create();
        factory(Fournisseurs::class, 5)->create()

            ->each(function ($t) {
                $t->article()->saveMany(
                    factory(Articles::class, 2)->make());

            });
        
    }
}
