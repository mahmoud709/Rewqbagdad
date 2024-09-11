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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('email', 100)->unique();
            $table->string('contact_email', 100)->unique();
            $table->string('phone', 30)->nullable();
            $table->text('map')->nullable();
            
            $table->string('logo_header', 200)->nullable();
            $table->string('logo_footer', 200)->nullable();
            $table->string('icon', 200)->nullable();

            $table->text('head_code')->nullable();
            $table->text('footer_code')->nullable();

            $table->string('facebook', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('youtube', 255)->nullable();
            $table->string('telegram', 255)->nullable();
            $table->string('tiktok', 255)->nullable();
            $table->string('whatsapp', 255)->nullable();

            $table->string('img_1', 255)->nullable();
            $table->string('img_2', 255)->nullable();
            $table->string('img_3', 255)->nullable();
            $table->string('img_4', 255)->nullable();
            $table->string('img_5', 255)->nullable();
            
            $table->string('img_1_link', 255)->nullable();
            $table->string('img_2_link', 255)->nullable();
            $table->string('img_3_link', 255)->nullable();
            $table->string('img_4_link', 255)->nullable();
            $table->string('img_5_link', 255)->nullable();

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
        Schema::dropIfExists('settings');
    }
};
