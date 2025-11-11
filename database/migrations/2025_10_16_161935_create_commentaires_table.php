<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->unsignedBigInteger('checkout_id')->nullable();
            $table->unsignedBigInteger('incident_id')->nullable();
            $table->unsignedBigInteger('reservation_id')->nullable();
            $table->foreign('checkout_id')->references('id')->on('checkouts')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->unsignedBigInteger('utilisateur_id')->nullable();
            $table->unsignedBigInteger('responsable_id')->nullable();
            $table->integer('etat')->nullable();
            $table->text('commentaire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
}
