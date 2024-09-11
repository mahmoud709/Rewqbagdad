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
        Schema::create('medianews_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);

            $table->string('title', 200)->nullable();
            $table->string('description', 255)->nullable();
            $table->text('content')->nullable();

            $table->text('tags')->nullable();

            $table->bigInteger('medianews_id')->unsigned();
            $table->foreign('medianews_id')->references('id')->on('medianews')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medianews_translations');
    }
};
