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
        Schema::create('versions', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('versioncategories')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('writer_id')->unsigned();
            $table->foreign('writer_id')->references('id')->on('bookteams')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('slug', 100)->nullable()->unique();
            $table->integer('views')->default(0);
            $table->string('img', 255)->nullable();
            $table->string('news_img', 255)->nullable();
            $table->string('pdf', 255)->nullable();

            // $table->date('publish_date', 50)->nullable();
            
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
        Schema::dropIfExists('versions');
    }
};
