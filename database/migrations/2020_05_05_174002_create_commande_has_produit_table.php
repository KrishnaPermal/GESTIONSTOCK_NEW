<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeHasProduitTable extends Migration
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
        Schema::create('commande_has_produit', function (Blueprint $table) {
            $table->dateTime('date');
            $table->string('quantity',255);
            $table->timestamps();
        });

        Schema::table('commande_has_produit', function (Blueprint $table) {
            $table->unsignedBigInteger('id_commande')->unsigned();
            $table->foreign('id_commande')->references('id')->on('commande');
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
        Schema::table('commande_has_produit', function (Blueprint $table) {
            $table->dropForeign(['id_commande']);
            $table->dropIfExists('id_commande');
            $table->dropForeign(['id_produit']);
            $table->dropIfExists('id_produit');
        });
        
        Schema::dropIfExists('commande_has_produit');
    }
}
