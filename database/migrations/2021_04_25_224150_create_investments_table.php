<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->double('mount');
            $table->double('percentage');
            $table->dateTime('ended_at');
            $table->unsignedBigInteger('investor_id');
            $table->unsignedBigInteger('investment_state_id')->default(1);
            $table->foreign('investor_id')->references('id')->on('investors');
            $table->foreign('investment_state_id')->references('id')->on('investment_states');
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
        Schema::dropIfExists('investments');
    }
}
