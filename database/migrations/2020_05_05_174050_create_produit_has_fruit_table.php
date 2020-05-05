<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitHasFruitTable extends Migration
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
        Schema::create('produit_has_fruit', function (Blueprint $table) {
            $table->unsignedBigInteger('id_fruit')->unsigned();
            $table->foreign('id_fruit')->references('id')->on('fruit');
            $table->unsignedBigInteger('id_produit')->unsigned();
            $table->foreign('id_produit')->references('id')->on('produit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('produit_has_fruit', function (Blueprint $table) {
            $table->dropForeign(['id_fruit']);
            $table->dropIfExists('id_fruit');
            $table->dropForeign(['id_produit']);
            $table->dropIfExists('id_produit');
        });

        Schema::dropIfExists('produit_has_fruit');
    }
}
