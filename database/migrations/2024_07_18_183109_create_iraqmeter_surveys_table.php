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
        Schema::create('iraqmeter_surveys', function (Blueprint $table) {
            $table->id();
            $table->string('photo', 255)->nullable();
            $table->string('pdf', 255)->nullable();
            $table->string('slug');
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iraqmeter_surveys');
    }
};
