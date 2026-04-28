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
        Schema::table('document_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('document_categories', 'name')) {
                $table->string('name')->after('id');
            }
            if (!Schema::hasColumn('document_categories', 'slug')) {
                $table->string('slug')->unique()->after('name');
            }
            if (!Schema::hasColumn('document_categories', 'description')) {
                $table->text('description')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('document_categories', 'icon')) {
                $table->string('icon')->nullable()->after('description');
            }
            if (!Schema::hasColumn('document_categories', 'color')) {
                $table->string('color')->nullable()->after('icon');
            }
            if (!Schema::hasColumn('document_categories', 'order')) {
                $table->integer('order')->default(0)->after('color');
            }
            if (!Schema::hasColumn('document_categories', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('order');
            }
            if (!Schema::hasColumn('document_categories', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('is_active');
            }
            if (!Schema::hasColumn('document_categories', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_categories', function (Blueprint $table) {
            $table->dropColumn(['name', 'slug', 'description', 'icon', 'color', 'order', 'is_active', 'meta_title', 'meta_description']);
        });
    }
};
