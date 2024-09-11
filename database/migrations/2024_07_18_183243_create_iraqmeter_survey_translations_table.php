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
        Schema::create('iraqmeter_survey_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->bigInteger('iraqmeter_survey_id')->unsigned();
            $table->foreign('iraqmeter_survey_id')->references('id')
            ->on('iraqmeter_surveys')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iraqmeter_survey_translations');
    }
};
