<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitHasRecompenseTable extends Migration
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
        Schema::create('produit_has_recompense', function (Blueprint $table) {
            $table->unsignedBigInteger('id_produit')->unsigned();
            $table->foreign('id_produit')->references('id')->on('produit');
            $table->unsignedBigInteger('id_recompense')->unsigned();
            $table->foreign('id_recompense')->references('id')->on('recompense');
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
        Schema::dropIfExists('produit_has_recompense');
        Schema::enableForeignKeyConstraints();
    }
}
