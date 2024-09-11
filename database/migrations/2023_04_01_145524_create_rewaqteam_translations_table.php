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
        Schema::create('rewaqteam_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);
            
            $table->string('name', 50)->nullable();
            $table->string('job_title', 50)->nullable();
            $table->text('description')->nullable();

            $table->bigInteger('rewaq_id')->unsigned();
            $table->foreign('rewaq_id')->references('id')->on('rewaqteams')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewaqteam_translations');
    }
};
