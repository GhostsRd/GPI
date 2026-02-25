<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('liaison_equipements', function (Blueprint $table) {
            $table->unsignedBigInteger('imprimante_id')->nullable()->after('flotte_id');
            $table->unsignedBigInteger('moniteur_id')->nullable()->after('imprimante_id');
            $table->unsignedBigInteger('peripherique_id')->nullable()->after('moniteur_id');
        });
    }

    public function down(): void
    {
        Schema::table('liaison_equipements', function (Blueprint $table) {
            $table->dropColumn(['imprimante_id', 'moniteur_id', 'peripherique_id']);
        });
    }
};
