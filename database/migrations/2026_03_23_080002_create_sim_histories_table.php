<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sim_histories', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('sim_card_id')->constrained('sim_cards')->onDelete('cascade');
            $blueprint->foreignId('user_id')->constrained('users')->onDelete('cascade'); // L'auteur de l'action
            $blueprint->string('action'); // attribution, recovery, loss, modification, deactivation
            $blueprint->json('details')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sim_histories');
    }
}
