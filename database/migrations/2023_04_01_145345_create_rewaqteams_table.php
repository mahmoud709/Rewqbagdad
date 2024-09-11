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
        Schema::create('rewaqteams', function (Blueprint $table) {
            $table->id();

            $table->integer('sort')->default(1);
            $table->string('img', 255)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('cv_link', 255)->nullable();

            $table->enum('type',['pm','am','ps'])->default('pm');

            // pm => مدير المشروع 
            // am => مساعد المدير 
            // ps => المشرف على المشروع
            
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
        Schema::dropIfExists('rewaqteams');
    }
};
