<?php

use App\Commandes;
use App\Fruits;
use App\Produits;
use App\Recompenses;
use Illuminate\Database\Seeder;

class ProduitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* factory(Produits::class, 5)
            ->create()
            ->each(function($a){
                $a->recompenses()->saveMany(factory(Recompenses::class,2)
                    ->make());
              
                $a->fruits()->saveMany(factory(Fruits::class,2)
                    ->make());
                    
                    
                $a->commandes()->saveMany(factory(Commandes::class,2)
                    ->make());
        
                });  */  
    }
}
