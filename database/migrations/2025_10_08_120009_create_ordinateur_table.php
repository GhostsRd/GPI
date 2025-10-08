<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_ordinateurs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ordinateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100)->unique();
            $table->string('entite', 100)->nullable();
            $table->string('sous_entite', 100)->nullable();
            $table->enum('statut', ['En service', 'En stock', 'Hors service', 'En réparation'])->default('En service');
            $table->string('fabricant', 100)->nullable();
            $table->string('modele', 100)->nullable();
            $table->string('numero_serie', 100)->unique()->nullable();

            // Clé étrangère vers l'utilisateur principal
            $table->foreignId('utilisateur_id')->nullable()->constrained('users')->onDelete('set null');

            // Clé étrangère vers l'usager secondaire
            $table->foreignId('usager_id')->nullable()->constrained('users')->onDelete('set null');

            $table->date('date_dernier_inventaire')->nullable();
            $table->integer('assistance_tickets')->default(0);
            $table->string('reseau_ip', 50)->nullable();
            $table->string('disque_dur', 50)->nullable();
            $table->string('os_version', 100)->nullable();
            $table->string('os_noyau', 100)->nullable();
            $table->datetime('derniere_date_demarrage')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordinateurs');
    }
};
