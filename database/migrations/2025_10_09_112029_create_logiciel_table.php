<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('logiciels', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 150);
            $table->string('editeur', 150)->nullable();
            $table->string('version_nom', 100)->nullable();
            $table->string('version_systeme_exploitation', 100)->nullable();
            $table->integer('nombre_installations')->default(0);
            $table->integer('nombre_licences')->default(0);
            $table->text('description')->nullable();
            $table->date('date_achat')->nullable();
            $table->date('date_expiration')->nullable();
            $table->timestamps();

            // Index pour les performances
            $table->index('nom');
            $table->index('editeur');
            $table->index('version_systeme_exploitation');
        });

        // Table pivot pour les installations sur les équipements
        Schema::create('logiciel_equipement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logiciel_id')->constrained()->onDelete('cascade');
            $table->bigInteger('equipement_id')->constrained()->onDelete('cascade');
            $table->date('date_installation');
            $table->string('version_installee', 100)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            //Empêcher les doublons
            $table->unique(['logiciel_id', 'equipement_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('logiciels');
        Schema::dropIfExists('logiciel_equipement');
    }
};