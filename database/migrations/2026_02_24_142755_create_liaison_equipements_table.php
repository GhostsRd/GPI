<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('liaison_equipements', function (Blueprint $table) {

            $table->id();

            // 🔗 Utilisateur lié
            $table->unsignedBigInteger('utilisateur_id');

            // 🔖 Type d’équipement (ordinateur, telephone, flotte, etc.)
            $table->string('type');

            // 🖥️ Équipements (nullable car un seul sera utilisé selon le type)
            $table->unsignedBigInteger('ordinateur_id')->nullable();
            $table->unsignedBigInteger('telephone_id')->nullable();
            $table->unsignedBigInteger('flotte_id')->nullable();
            $table->unsignedBigInteger('imprimante_id')->nullable();
            $table->unsignedBigInteger('moniteur_id')->nullable();
            $table->unsignedBigInteger('peripherique_id')->nullable();

            // 📅 Dates de gestion
            $table->date('date_attribution')->nullable();
            $table->date('date_retour_prevue')->nullable();
            $table->date('date_retour_effectif')->nullable();

            // 📝 Informations supplémentaires
            $table->text('notes')->nullable();

            // 🔄 Statut de la liaison (actif, retourné, perdu, etc.)
            $table->string('statut')->default('actif');

            $table->timestamps();

            // ==============================
            // 🔐 Clés étrangères
            // ==============================

            $table->foreign('utilisateur_id')
                ->references('id')
                ->on('utilisateurs')
                ->cascadeOnDelete();

            $table->foreign('ordinateur_id')
                ->references('id')
                ->on('ordinateurs')
                ->nullOnDelete();

        

         

            $table->foreign('imprimante_id')
                ->references('id')
                ->on('imprimantes')
                ->nullOnDelete();

            $table->foreign('moniteur_id')
                ->references('id')
                ->on('moniteurs')
                ->nullOnDelete();

            $table->foreign('peripherique_id')
                ->references('id')
                ->on('peripheriques')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liaison_equipements');
    }
};