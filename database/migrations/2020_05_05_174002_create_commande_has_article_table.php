<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeHasArticleTable extends Migration
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
        Schema::create('commande_has_article', function (Blueprint $table) {
            $table->string('quantity',255)->nullable();
        });

        Schema::table('commande_has_article', function (Blueprint $table) {
            $table->unsignedBigInteger('id_commande')->unsigned();
            $table->foreign('id_commande')->references('id')->on('commande');
            $table->unsignedBigInteger('id_article')->unsigned();
            $table->foreign('id_article')->references('id')->on('article');
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
        Schema::dropIfExists('commande_has_article');
        Schema::enableForeignKeyConstraints();
    }
}
