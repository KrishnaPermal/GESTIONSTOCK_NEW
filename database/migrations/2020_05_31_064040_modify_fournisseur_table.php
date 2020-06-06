<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFournisseurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fournisseur', function (Blueprint $table) {
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id')->on('users');
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
