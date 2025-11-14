<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('departement_id')->nullable()->constrained()->onDelete('set null');
            $table->string('type_materiel')->nullable();
            $table->unsignedBigInteger('materiel_id')->nullable();
            $table->date('date_incident');
            $table->string('nature_incident');
            $table->string('numero_rapport')->unique()->nullable();
            $table->text('details_panne')->nullable();
            $table->string('lieu_perte')->nullable();
            $table->text('observation')->nullable();
            $table->enum('statut_final', ['nouveau', 'en_cours', 'resolu', 'clos'])->default('nouveau');
            $table->foreignId('technicien_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            // Index pour les performances
            $table->index('date_incident');
            $table->index('statut_final');
            $table->index('type_materiel');
        });
    }

    public function down()
    {
        Schema::dropIfExists('incidents');
    }
};