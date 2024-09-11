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
        Schema::create('bookteam_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);
            
            $table->string('name', 50)->nullable();
            $table->string('job_title', 50)->nullable();
            $table->text('description')->nullable();

            $table->bigInteger('bookteam_id')->unsigned();
            $table->foreign('bookteam_id')->references('id')->on('bookteams')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookteam_translations');
    }
};
