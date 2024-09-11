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
        Schema::create('electronicservice_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);

            $table->string('title', 100)->nullable();

            $table->text('description')->nullable();
            $table->text('content')->nullable();

            $table->bigInteger('electronic_id')->unsigned();
            $table->foreign('electronic_id')->references('id')->on('electronicservices')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('electronicservice_translations');
    }
};
