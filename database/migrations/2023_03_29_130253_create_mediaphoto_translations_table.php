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
        Schema::create('mediaphoto_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);
            $table->string('title', 255)->nullable();
            
            $table->bigInteger('mediaphoto_id')->unsigned();
            $table->foreign('mediaphoto_id')->references('id')->on('mediaphotos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mediaphoto_translations');
    }
};
