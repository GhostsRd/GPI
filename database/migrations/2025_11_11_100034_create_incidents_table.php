<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->integer('equipement_id');
            $table->integer('utilisateur_id');
            $table->integer('commentaire_id')->nullable();
            $table->integer('statut')->default(1);
            $table->string('equipement_type');
            $table->string('incident_sujet');
            $table->string('incident_description');
            $table->string('incident_nature');
            $table->string('rapport_incident');
            $table->string('declaration_perte')->nullable();
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
        Schema::dropIfExists('incidents');
    }
}
