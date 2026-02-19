<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            // Ajouter la colonne category_id si elle n'existe pas
            if (!Schema::hasColumn('documents', 'category_id')) {
                $table->foreignId('category_id')
                    ->nullable()
                    ->after('content')
                    ->constrained('document_categories')
                    ->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};