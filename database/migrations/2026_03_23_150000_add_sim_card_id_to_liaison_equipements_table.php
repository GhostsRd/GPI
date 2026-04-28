<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSimCardIdToLiaisonEquipementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('liaison_equipements', function (Blueprint $table) {
            $table->foreignId('sim_card_id')
                ->nullable()
                ->after('flotte_id')
                ->constrained('sim_cards')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('liaison_equipements', function (Blueprint $table) {
            $table->dropForeign(['sim_card_id']);
            $table->dropColumn('sim_card_id');
        });
    }
}
