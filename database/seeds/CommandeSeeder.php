<?php


use App\Commandes;
use App\Produits;
use App\Users;
use Illuminate\Database\Seeder;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Commandes::class, 5)->create()
        ->each(function ($u) {
            $u->produit()->saveMany(factory(Produits::class, 1)->make()
            )
        ->each(function ($p) {
            $p->user()->saveMany(factory(Users::class, 1)->make());
            });
        });
    }
}
