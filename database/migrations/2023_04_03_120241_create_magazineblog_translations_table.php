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
        Schema::create('magazineblog_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);

            $table->string('title', 200)->nullable();
            $table->string('description', 255)->nullable();
            
            $table->text('tags')->nullable();
            $table->string('writer', 100)->nullable();
            
            $table->text('content')->nullable();
            
            $table->string('title_1', 200)->nullable();
            $table->text('content_1')->nullable();
            $table->string('title_2', 200)->nullable();
            $table->text('content_2')->nullable();
            $table->string('title_3', 200)->nullable();
            $table->text('content_3')->nullable();
            $table->string('title_4', 200)->nullable();
            $table->text('content_4')->nullable();
            $table->string('title_5', 200)->nullable();
            $table->text('content_5')->nullable();
            $table->string('title_6', 200)->nullable();
            $table->text('content_6')->nullable();
            $table->string('title_7', 200)->nullable();
            $table->text('content_7')->nullable();
            $table->string('title_8', 200)->nullable();
            $table->text('content_8')->nullable();
            $table->string('title_9', 200)->nullable();
            $table->text('content_9')->nullable();

            
            $table->bigInteger('parent_id')->unsigned();
            $table->foreign('parent_id')->references('id')->on('magazineblogs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magazineblog_translations');
    }
};
