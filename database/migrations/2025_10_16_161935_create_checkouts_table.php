<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('responsable_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('equipement_id')->constrained()->cascadeOnDelete()->nullable();
            $table->bigInteger('commentaire_id')->constrained()->cascadeOnDelete()->nullable();
            $table->integer('statut')->default(1);
            $table->string('materiel_type')->nullable();
            $table->string('materiel_details')->nullable();
            $table->dateTime('date_rendu')->nullable();
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
        Schema::dropIfExists('checkouts');
    }
}
