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
        Schema::create('etmam_news', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('etmamcategories')->onDelete('cascade')->onUpdate('cascade');

            $table->string('slug', 100)->nullable()->unique();
            $table->integer('views')->default(0);
            $table->string('img', 255)->nullable();
            $table->string('news_img', 255)->nullable();
            $table->string('url', 255)->nullable();

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
        Schema::dropIfExists('etmam_news');
    }
};
