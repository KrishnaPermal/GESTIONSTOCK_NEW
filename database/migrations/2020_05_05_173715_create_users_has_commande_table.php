<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersHasCommandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        //Schema::enableForeignKeyConstraints();
        Schema::create('users_has_commande', function (Blueprint $table) {
            $table->unsignedBigInteger('id_users')->unsigned();
            $table->foreign('id_users')->references('id')->on('users');
            $table->unsignedBigInteger('id_commande')->unsigned();
            $table->foreign('id_commande')->references('id')->on('commande');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users_has_commande');
        Schema::enableForeignKeyConstraints();
    }
}
