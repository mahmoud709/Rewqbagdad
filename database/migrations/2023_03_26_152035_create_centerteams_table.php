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
        Schema::create('centerteams', function (Blueprint $table) {
            $table->id();

            $table->string('img', 255)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('cv_link', 255)->nullable();

            $table->enum('type',['cbd','ceo','mem','emp'])->default('cbd');
            //cbd => رئيس مجلس الإدارة 
            //ceo => المدير التنفيذي
            //mem => عضو مجلس الإدارة
            //emp => موظف الرواق  


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
        Schema::dropIfExists('centerteams');
    }
};
