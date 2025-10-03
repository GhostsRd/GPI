<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('utilisateur_id')->nullable();
            $table->integer('responsable_id')->nullable();
            $table->integer('commentaire_id')->nullable();
            $table->integer("state")->default(1);
            $table->string('equipementSeeder')->nullable();
            $table->string('categorie')->nullable();
            $table->string("impact");
            $table->string('sujet')->nullable();
            $table->string('details')->nullable();
            $table->boolean('priorite')->default(false);
            $table->string('status')->nullable();
            $table->string('quantite')->nullable();
            $table->boolean("archive")->default(false);
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
        Schema::dropIfExists('tickets');
    }
}
