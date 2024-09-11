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
        Schema::create('magazineteams', function (Blueprint $table) {
            $table->id();
            
            $table->integer('sort')->default(1);
            $table->string('img', 255)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('cv_link', 255)->nullable();

            $table->enum('type',['cbd','ec','dec','me','es'])->default('cbd');
            //cbd => رئيس مجلس الإدارة 
            //ec => رئيس التحرير
            //dec => نائب رئيس التحرير
            //me => مدير التحرير  
            //es => سكرتير التحرير 
            
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
        Schema::dropIfExists('magazineteams');
    }
};
