<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresses', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('firstname',255);
            $table->string('country',255);
            $table->string('address',255);
            $table->string('city',255);
            $table->string('postal_code',255);
            $table->string('phone',255);
            $table->timestamps();


            $table->unsignedBigInteger('id_users')->nullable();
            $table->foreign('id_users')->references('id')->on('users');
        });

        Schema::table('commande', function (Blueprint $table) {
            $table->unsignedBigInteger('id_adresse_livraison')->nullable();
            $table->foreign('id_adresse_livraison')->references('id')->on('adresses');

            $table->unsignedBigInteger('id_adresse_facturation')->nullable();
            $table->foreign('id_adresse_facturation')->references('id')->on('adresses');
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
        Schema::dropIfExists('adresses');
        Schema::enableForeignKeyConstraints();
    }
}
