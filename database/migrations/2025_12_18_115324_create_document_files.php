<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_files', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du fichier
            $table->string('path'); // Chemin ou URL du fichier
            $table->string('type')->nullable(); // Type de fichier (PDF, image, etc.)
            $table->unsignedBigInteger('category_id')->nullable(); // Référence à une catégorie
            $table->timestamps();

            // Clé étrangère si tu as une table de catégories
            $table->foreign('category_id')
                  ->references('id')
                  ->on('document_categories')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_files');
    }
}
