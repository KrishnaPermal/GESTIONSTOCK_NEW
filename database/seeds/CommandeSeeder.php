<?php

use App\Articles;
use App\Commandes;
use App\User;
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
            $u->article()->saveMany(factory(Articles::class, 1)->make()
        );
        //->each(function ($p) {
           // $p->user()->saveMany(factory(User::class, 1)->make());
            //});
        });
    }
}
