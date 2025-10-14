<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeripheriquesTable extends Migration
{
    public function up(): void
    {
        Schema::create('peripheriques', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('type');
            $table->enum('statut', ['En service', 'En stock', 'Hors service', 'En réparation'])->default('En stock');
            $table->string('fabricant')->nullable();
            $table->string('modele')->nullable();
            $table->string('numero_serie')->nullable()->unique();
            $table->string('entite')->nullable();
            $table->string('lieu')->nullable();
            $table->string('usager')->nullable();
            $table->string('adresse_ip')->nullable();
            $table->string('mac_address')->nullable();
            $table->text('caracteristiques')->nullable();
            $table->date('date_acquisition')->nullable();
            $table->date('date_fin_garantie')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Index pour les performances
            $table->index('statut');
            $table->index('type');
            $table->index('fabricant');
            $table->index('entite');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peripheriques');
    }
};
