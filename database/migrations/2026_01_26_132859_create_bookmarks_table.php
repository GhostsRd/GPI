<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            
            // Colonnes pour la relation many-to-many
            $table->foreignId('user_id')
                  ->constrained() // Référence à la table users
                  ->onDelete('cascade'); // Supprime les favoris si l'utilisateur est supprimé
                  
            $table->foreignId('document_id')
                  ->constrained() // Référence à la table documents
                  ->onDelete('cascade'); // Supprime les favoris si le document est supprimé
                  
            $table->timestamps();
            
            // Clé unique pour éviter les doublons
            $table->unique(['user_id', 'document_id']);
            
            // Index pour les performances
            $table->index('user_id');
            $table->index('document_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
}