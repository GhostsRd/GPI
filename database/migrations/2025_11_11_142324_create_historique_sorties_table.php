<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriqueSortiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historique_sorties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peripherique_id')->constrained()->onDelete('cascade');
            $table->enum('type_operation', ['sortie', 'retour']);
            $table->string('usager')->nullable();
            $table->string('entite')->nullable();
            $table->string('lieu')->nullable();
            $table->datetime('date_operation');
            $table->string('etat')->default('Bon');
            $table->text('commentaire')->nullable();
            $table->timestamps();

            $table->index('peripherique_id');
            $table->index('type_operation');
            $table->index('date_operation');
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('historique_sorties');
    }
}
