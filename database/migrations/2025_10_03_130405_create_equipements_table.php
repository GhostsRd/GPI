<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipements', function (Blueprint $table) {
            $table->id();
            $table->string('identification')->unique();
            $table->string('nom_public');
            $table->string('emplacement');
            $table->string('marque');
            $table->string('model');
            $table->string('type');
            $table->string('numero_serie')->nullable();
            $table->string('couleur')->default('noir');
            $table->string('technologie_impression')->nullable();
            $table->string('reference_cartouche')->nullable();
            $table->date('date_entree_stock');
            $table->string('adresse_ip')->nullable();
            $table->enum('statut', ['en_stock', 'en_pret', 'en_maintenance'])->default('en_stock');
            $table->text('description')->nullable();
            $table->timestamps();

            // Index pour optimiser les recherches
            $table->index('statut');
            $table->index('type');
            $table->index('emplacement');
            $table->index('marque');
            $table->index('identification');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipements');
    }
}
