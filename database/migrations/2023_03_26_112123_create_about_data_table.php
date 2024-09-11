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
        Schema::create('about_data', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['targets','vision','means','our_message'])->default('targets');
            $table->string('content_ar', 255)->nullable();
            $table->string('content_en', 255)->nullable();
            $table->string('name_ar', 255)->nullable();
            $table->string('name_en', 255)->nullable();

            $table->bigInteger('about_id')->unsigned();
            $table->foreign('about_id')->references('id')->on('abouts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_data');
    }
};
