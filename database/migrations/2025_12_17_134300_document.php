<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->longText('content');
            $table->enum('category', [
                'guides', 
                'tutorials', 
                'references', 
                'faq', 
                'security', 
                'procedures'
            ]);
            $table->enum('type', [
                'pdf', 
                'article', 
                'video', 
                'guide', 
                'reference'
            ]);
            $table->integer('reading_time')->default(5); // en minutes
            $table->integer('views')->default(0);
            $table->integer('downloads')->default(0);
            $table->boolean('is_published')->default(true);
            $table->json('attachments')->nullable();
            $table->json('meta_data')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('document_favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('document_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->unique(['user_id', 'document_id']);
        });

        Schema::create('document_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('document_id')->constrained()->onDelete('cascade');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('document_views');
        Schema::dropIfExists('document_favorites');
        Schema::dropIfExists('documents');
    }
};