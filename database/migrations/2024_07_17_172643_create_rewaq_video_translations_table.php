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
        Schema::create('rewaq_video_translations', function (Blueprint $table) {
            $table->id();
            
            $table->string('locale', 5);

            $table->string('name', 200)->nullable();

            $table->bigInteger('video_id')->unsigned();

            $table->foreign('video_id')->references('id')
            ->on('rewaq_videos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewaq_video_translations');
    }
};
