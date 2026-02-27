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

    $table->foreignId('utilisateur_id')
        ->constrained('utilisateurs')
        ->cascadeOnDelete();

    $table->string('type');

    $table->foreignId('ordinateur_id')
        ->nullable()
        ->constrained('ordinateurs')
        ->nullOnDelete();

    $table->foreignId('telephone_id')
        ->nullable()
        ->constrained('telephones')
        ->nullOnDelete();

    $table->foreignId('flotte_id')
        ->nullable()
        ->constrained('flottes')
        ->nullOnDelete();

    $table->foreignId('imprimante_id')
        ->nullable()
        ->constrained('imprimantes')
        ->nullOnDelete();

    $table->foreignId('moniteur_id')
        ->nullable()
        ->constrained('moniteurs')
        ->nullOnDelete();

    $table->foreignId('peripherique_id')
        ->nullable()
        ->constrained('peripheriques')
        ->nullOnDelete();

    $table->date('date_attribution')->nullable();
    $table->date('date_retour_prevue')->nullable();
    $table->date('date_retour_effectif')->nullable();

    $table->text('notes')->nullable();
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