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
        Schema::create('upcomingtrainings', function (Blueprint $table) {
            $table->id();
            $table->string('photo', 255)->nullable();
            $table->string('slug');
            $table->integer('views')->default(0);
            $table->float('price');
            $table->dateTime('training_appointment');
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
        Schema::dropIfExists('upcomingtrainings');
    }
};
