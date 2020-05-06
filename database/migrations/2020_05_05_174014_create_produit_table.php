<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->string('quantity',255);
            $table->string('price',255);
        });

        Schema::table('produit', function (Blueprint $table) {
            $table->unsignedBigInteger('id_producteur');
            $table->foreign('id_producteur')->references('id')->on('producteur');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('produit', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['id_producteur']);
            $table->dropIfExists('id_producteur');
        });
        
        Schema::dropIfExists('produit');
    }
}
