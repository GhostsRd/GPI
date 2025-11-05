<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutreserversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkoutreservers', function (Blueprint $table) {
            $table->id();
            $table->integer('responsable_id');
            $table->integer('equipement_id');
            $table->string('equipement_type');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('equipement_nombre')->default(1);
            $table->integer('statut')->default(1); /* 0 pour disponible et 1 pour occuper*/ 
            $table->string('commentaire')->nullable();
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
        Schema::dropIfExists('checkoutreservers');
    }
}
