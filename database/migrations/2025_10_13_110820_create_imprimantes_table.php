<?php
// database/migrations/2024_01_01_000000_create_imprimantes_table.php

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
        Schema::create('imprimantes', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->string('entite', 100)->nullable();
            $table->enum('statut', ['En service', 'En stock', 'Hors service', 'En réparation','Disponible'])->default('En service');
            $table->string('fabricant', 100)->nullable();
            $table->string('reseau_ip', 45)->nullable(); // IPv6 support
            $table->string('numero_serie', 100)->nullable()->unique();
            $table->string('lieu', 150)->nullable();
            $table->string('type', 50)->nullable(); // Laser, Jet d'encre, Multifonction
            $table->string('modele', 100)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('date_achat')->nullable();
            $table->timestamp('date_installation')->nullable();
            $table->timestamp('date_garantie')->nullable();
            $table->timestamps();

            // Index pour les performances
            $table->index('nom');
            $table->index('statut');
            $table->index('fabricant');
            $table->index('entite');
            $table->index('type');
            $table->index('created_at');
            $table->index('updated_at');
        });

        // Table pour l'historique des modifications (optionnel)
        Schema::create('imprimante_historique', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imprimante_id')->constrained()->onDelete('cascade');
            $table->string('action'); // CREATE, UPDATE, DELETE
            $table->json('anciennes_valeurs')->nullable();
            $table->json('nouvelles_valeurs')->nullable();
            $table->string('utilisateur')->nullable();
            $table->timestamps();

            $table->index('imprimante_id');
            $table->index('action');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imprimante_historique');
        Schema::dropIfExists('imprimantes');
    }
};
