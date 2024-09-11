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
        Schema::create('magazineblogs', function (Blueprint $table) {
            $table->id();

            $table->string('slug', 100)->nullable()->unique();
            $table->string('img', 255)->nullable();
            
            $table->string('number', 50)->nullable();

            $table->string('pdf', 255)->nullable();
            $table->string('promo_url', 255)->nullable();
            
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
        Schema::dropIfExists('magazineblogs');
    }
};
