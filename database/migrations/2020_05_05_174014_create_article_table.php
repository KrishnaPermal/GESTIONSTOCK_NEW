<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('article_ref',255);
            $table->string('mark',255);
            $table->string('description',255);
            $table->string('provider',255);
            $table->string('quantity',255);
            $table->string('price',255);
            $table->string('photo');
            $table->softDeletes();

            $table->unsignedBigInteger('id_fournisseur');
            $table->foreign('id_fournisseur')->references('id')->on('fournisseur');

            $table->unsignedBigInteger('id_categorie');
            $table->foreign('id_categorie')->references('id')->on('categorie');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
    public function down()
    {

        Schema::table('article', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropIfExists('id_fournisseur');
            $table->dropIfExists('id_categorie');
            Schema::enableForeignKeyConstraints();
        });
        
        Schema::dropIfExists('article');
    }


}
