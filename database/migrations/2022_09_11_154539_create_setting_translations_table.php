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
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);
            
            $table->string('name', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('address', 200)->nullable();
            $table->string('work_hours', 150)->nullable();

            $table->string('img_1', 50)->nullable();
            $table->string('img_2', 50)->nullable();
            $table->string('img_3', 50)->nullable();
            $table->string('img_4', 50)->nullable();
            $table->string('img_5', 50)->nullable();

            $table->bigInteger('setting_id')->unsigned();
            $table->foreign('setting_id')->references('id')->on('settings')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_translations');
    }
};
