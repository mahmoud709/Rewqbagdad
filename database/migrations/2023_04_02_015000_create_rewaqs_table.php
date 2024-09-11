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
        Schema::create('rewaqs', function (Blueprint $table) {
            
            $table->id();
            $table->string('img', 255)->nullable();
            $table->string('contact_email', 50)->nullable();

            $table->bigInteger('pm_id')->unsigned()->nullable();
            $table->foreign('pm_id')->references('id')->on('rewaqteams')->onDelete('set null')->onUpdate('cascade');
            
            $table->bigInteger('am_id')->unsigned()->nullable();
            $table->foreign('am_id')->references('id')->on('rewaqteams')->onDelete('set null')->onUpdate('cascade');

            $table->bigInteger('ps_id')->unsigned()->nullable();
            $table->foreign('ps_id')->references('id')->on('rewaqteams')->onDelete('set null')->onUpdate('cascade');

            $table->json('team_ids')->nullable();
            
            $table->string('facebook', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('youtube', 255)->nullable();
            $table->string('telegram', 255)->nullable();
            $table->string('tiktok', 255)->nullable();
            $table->string('whatsapp', 255)->nullable();

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
        Schema::dropIfExists('rewaqs');
    }
};
