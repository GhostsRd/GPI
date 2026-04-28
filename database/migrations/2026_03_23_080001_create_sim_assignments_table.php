<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sim_assignments', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('sim_card_id')->constrained('sim_cards')->onDelete('cascade');
            $blueprint->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $blueprint->timestamp('assigned_at')->useCurrent();
            $blueprint->timestamp('returned_at')->nullable();
            $blueprint->enum('status', ['active', 'returned', 'lost'])->default('active');
            $blueprint->string('document_path')->nullable();
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
        Schema::dropIfExists('sim_assignments');
    }
}
