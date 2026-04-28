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
        Schema::table('documents', function (Blueprint $table) {
            if (!Schema::hasColumn('documents', 'file_name')) {
                $table->string('file_name')->nullable()->after('is_published');
            }
            if (!Schema::hasColumn('documents', 'file_path')) {
                $table->string('file_path')->nullable()->after('file_name');
            }
            if (!Schema::hasColumn('documents', 'file_size')) {
                $table->unsignedBigInteger('file_size')->nullable()->after('file_path');
            }
            if (!Schema::hasColumn('documents', 'file_extension')) {
                $table->string('file_extension')->nullable()->after('file_size');
            }
            if (!Schema::hasColumn('documents', 'video_url')) {
                $table->string('video_url')->nullable()->after('file_extension');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn([
                'file_name',
                'file_path',
                'file_size',
                'file_extension',
                'video_url'
            ]);
        });
    }
};
