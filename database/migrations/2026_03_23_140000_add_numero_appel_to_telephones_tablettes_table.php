<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumeroAppelToTelephonesTablettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('telephones_tablettes', function (Blueprint $table) {
            $table->string('numero_appel')->nullable()->after('imei');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('telephones_tablettes', function (Blueprint $table) {
            $table->dropColumn('numero_appel');
        });
    }
}
