<?php

use App\Articles;
use App\Categories;
use App\Commandes;
use App\Recompenses;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         /* factory(Articles::class, 5)
            ->create()
            ->each(function($a){
                $a->recompenses()->saveMany(factory(Recompenses::class,2)
                    ->make());
              
                $a->categories()->saveMany(factory(Categories::class,2)
                    ->make());
                    
                    
                $a->commandes()->saveMany(factory(Commandes::class,2)
                    ->make());
        
                });   */
    }
}
