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
        factory(Fournisseurs::class, 3)->create()
        
            ->each(function($t){
                $t->article()->saveMany(
                   factory(Articles::class,2)->make())

                    /* ->each(function($a){
                         $a->recompenses()->saveMany(factory(Recompenses::class,1)->make());
                     }) */
                    ->each(function($n){
                        $n->categories()->saveMany(factory(Categories::class,2)->make());
                    });
        
             });   
    }
}
