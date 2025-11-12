<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_moniteurs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('moniteurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100)->unique();
            $table->string('entite', 100)->nullable();
            $table->string(column: 'statut', length: 100) ->nullable();
            $table->string('fabricant', 100)->nullable();
            $table->string('numero_serie', 100)->unique()->nullable();

            // Clé étrangère vers l'utilisateur principal
            $table->foreignId('utilisateur_id')->nullable()->constrained('users')->onDelete('set null');

            // Clé étrangère vers l'usager secondaire
            $table->foreignId('usager_id')->nullable()->constrained('users')->onDelete('set null');

            $table->string('lieu', 150)->nullable();
            $table->string('type', 50)->nullable(); // LCD, LED, 4K, etc.
            $table->string('modele', 100)->nullable();
            $table->text('commentaires')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('moniteurs');
    }
};
