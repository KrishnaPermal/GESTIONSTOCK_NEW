<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleHasCategorieTable extends Migration
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
        Schema::create('article_has_categorie', function (Blueprint $table) {
            $table->unsignedBigInteger('id_categorie')->unsigned();
            $table->foreign('id_categorie')->references('id')->on('categorie');
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
        Schema::dropIfExists('article_has_categorie');
        Schema::enableForeignKeyConstraints();
    }
}
