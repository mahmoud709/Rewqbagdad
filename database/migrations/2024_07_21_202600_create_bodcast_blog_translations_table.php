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
        Schema::create('bodcast_blog_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);

            $table->string('title', 200)->nullable();
            $table->string('description', 255)->nullable();
            $table->text('content')->nullable();

            $table->text('tags')->nullable();

            $table->bigInteger('bodcast_blog_id')->unsigned();
            $table->foreign('bodcast_blog_id')->references('id')
            ->on('bodcast_blogs')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bodcast_blog_translations');
    }
};
