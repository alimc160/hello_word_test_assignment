<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_prediction_countries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_prediction_id');
            $table->foreign('user_prediction_id')->references('id')->on('user_predictions');
            $table->string('country_id');
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
        Schema::dropIfExists('user_predection_countries');
    }
};
