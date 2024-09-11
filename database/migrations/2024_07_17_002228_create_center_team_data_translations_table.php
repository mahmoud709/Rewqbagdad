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
        Schema::create('center_team_data_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);
            $table->text('content')->nullable();
            $table->bigInteger('center_team_data_id')->unsigned();
            $table->foreign('center_team_data_id')->references('id')->on('center_team_data')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('center_team_data_translations');
    }
};
