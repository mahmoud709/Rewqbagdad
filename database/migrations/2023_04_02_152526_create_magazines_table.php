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
        Schema::create('magazines', function (Blueprint $table) {
            $table->id();

            $table->string('img', 255)->nullable();
            $table->string('contact_email', 50)->nullable();

            $table->bigInteger('cbd_id')->unsigned()->nullable();
            $table->foreign('cbd_id')->references('id')->on('magazineteams')->onDelete('set null')->onUpdate('cascade');

            $table->bigInteger('ec_id')->unsigned()->nullable();
            $table->foreign('ec_id')->references('id')->on('magazineteams')->onDelete('set null')->onUpdate('cascade');

            $table->bigInteger('dec_id')->unsigned()->nullable();
            $table->foreign('dec_id')->references('id')->on('magazineteams')->onDelete('set null')->onUpdate('cascade');

            $table->bigInteger('me_id')->unsigned()->nullable();
            $table->foreign('me_id')->references('id')->on('magazineteams')->onDelete('set null')->onUpdate('cascade');

            $table->bigInteger('es_id')->unsigned()->nullable();

            $table->foreign('es_id')->references('id')

            ->on('magazineteams')

            ->onDelete('set null')->onUpdate('cascade');
            
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
        Schema::dropIfExists('magazines');
    }
};
