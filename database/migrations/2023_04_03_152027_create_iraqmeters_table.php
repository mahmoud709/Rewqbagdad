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
        Schema::create('iraqmeters', function (Blueprint $table) {
            $table->id();

            $table->string('slug', 100)->nullable()->unique();
            $table->integer('views')->default(0);
            $table->string('img', 255)->nullable();
            $table->string('news_img', 255)->nullable();

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
        Schema::dropIfExists('iraqmeters');
    }
};
