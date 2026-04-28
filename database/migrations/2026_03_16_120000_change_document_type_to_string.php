<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Utiliser une requête brute pour éviter la dépendance à doctrine/dbal dans Laravel 8
        DB::statement("ALTER TABLE documents MODIFY COLUMN type VARCHAR(255) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revenir à l'ENUM d'origine
        DB::statement("ALTER TABLE documents MODIFY COLUMN type ENUM('pdf', 'article', 'video', 'guide', 'reference') NULL");
    }
};
