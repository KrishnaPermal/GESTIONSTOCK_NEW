<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisseurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseur', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->string('firstname',255);
            $table->string('phone',255);
            $table->string('email',255);
            $table->string('address',255);
        
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
        Schema::dropIfExists('fournisseur');
        Schema::enableForeignKeyConstraints();
    }
}
