<?php
// database/migrations/xxxx_xx_xx_create_telephones_tablettes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelephonesTablettesTable extends Migration
{
    public function up()
    {
        Schema::create('telephones_tablettes', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->string('entite', 100)->nullable();
            $table->string('usager', 100)->nullable();
            $table->string('lieu', 150);
            $table->text('services')->nullable();
            $table->string('type', 50);
            $table->string('marque', 100);
            $table->string('modele', 100);
            $table->string('numero_serie', 100)->unique();
            $table->enum('statut', ['En service', 'En stock', 'Hors service', 'En réparation'])->default('En service');
            $table->string('emplacement_actuel', 150);
            $table->string('imei', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('telephones_tablettes');
    }
}