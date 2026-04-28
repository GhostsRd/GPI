<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sim_cards', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('phone_number')->unique();
            $blueprint->string('iccid')->unique();
            $blueprint->string('operator'); // Orange, Telma, Airtel
            $blueprint->enum('status', ['available', 'assigned', 'lost', 'deactivated'])->default('available');
            $blueprint->date('activation_date')->nullable();
            $blueprint->foreignId('current_user_id')->nullable()->constrained('users')->onDelete('set null');
            $blueprint->string('department')->nullable();
            $blueprint->string('device_model')->nullable();
            $blueprint->string('imei')->nullable();
            $blueprint->string('location')->nullable();
            $blueprint->text('remarks')->nullable();
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
        Schema::dropIfExists('sim_cards');
    }
}
