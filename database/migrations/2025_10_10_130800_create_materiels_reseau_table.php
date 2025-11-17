<?php
// database/migrations/2024_01_01_000000_create_materiels_reseau_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterielsReseauTable extends Migration
{
    public function up()
    {
        Schema::create('materiels_reseau', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->string('entite', 100)->nullable();
             $table->enum('statut', ['En service', 'En stock', 'Hors service', 'En réparation','Disponible'])->default('En service');
            $table->string('fabricant', 100)->nullable();
            $table->string('lieu', 150)->nullable();
            $table->string('reseau_ip', 50)->nullable();
            $table->string('type', 100)->nullable(); // Switch, Routeur, Point d'accès, Pare-feu
            $table->string('modele', 100)->nullable();
            $table->string('numero_serie', 100)->unique()->nullable();
            $table->timestamps();
            
            $table->index(['statut', 'entite']);
            $table->index('type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('materiels_reseau');
    }
}


