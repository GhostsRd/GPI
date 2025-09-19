<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Collecteur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collecteur', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('CIF')->nullable();
            $table->string('NIF')->nullable();
            $table->string('CIN')->nullable();
            $table->string('RCS')->nullable();
            $table->string('STAT')->nullable();
            $table->string('produit')->nullable();
            $table->string('adresse')->nullable();
            $table->string('url_img')->nullable();
       


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    //Schema::dropIfExists('collecteur');
    }
}
