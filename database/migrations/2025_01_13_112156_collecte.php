<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Collecte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collecte', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('quantite')->nullable();
            $table->string('unite')->nullable();
            $table->string('date_collecte')->nullable();
            $table->string('image_quitance')->nullable();
            $table->string('ristourne_calculee')->nullable();
            $table->string('collecteur_id')->nullable();
            $table->string('produit_id')->nullable();
            $table->string('regisseur_id')->nullable();
            $table->string('commune')->nullable();
            $table->string('numero_quitance')->nullable();
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
        //
    }
}
