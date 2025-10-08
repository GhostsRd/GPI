<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('equipements_it', function (Blueprint $table) {
            $table->id();
            $table->enum('type_equipement', [
                'Ordinateur', 'Moniteur', 'Logiciel', 'Imprimante',
                'Matériel Réseau', 'Périphérique', 'Téléphone/Tablette'
            ]);

            $table->string('nom');
            $table->string('entite')->nullable();
            $table->string('statut')->nullable();
            $table->string('fabricant')->nullable();
            $table->string('modele')->nullable();
            $table->string('numero_serie')->nullable();
            $table->string('usager')->nullable();
            $table->string('utilisateur')->nullable();
            $table->string('lieu')->nullable();
            $table->string('reseau_ip')->nullable();
            $table->string('type_imprimante')->nullable();
            $table->string('type_reseau')->nullable();
            $table->string('type_peripherique')->nullable();
            $table->string('services')->nullable();
            $table->string('emplacement_actuel')->nullable();
            $table->string('imei')->nullable();
            $table->string('systeme_exploitation_version')->nullable();
            $table->string('systeme_exploitation_noyau')->nullable();
            $table->string('composants_taille_disque')->nullable();
            $table->date('date_dernier_inventaire')->nullable();
            $table->integer('assistance_nombre_tickets')->nullable();
            $table->text('sous_entites')->nullable();
            $table->text('commentaires')->nullable();
            $table->string('editeur')->nullable();
            $table->string('version_nom')->nullable();
            $table->string('version_systeme_exploitation')->nullable();
            $table->integer('nombre_installations')->nullable();
            $table->integer('nombre_licences')->nullable();
            $table->dateTime('derniere_date_demarrage')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipements_it');
    }
};
