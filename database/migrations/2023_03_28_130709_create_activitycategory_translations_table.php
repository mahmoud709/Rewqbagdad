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
        Schema::create('activitycategory_translation', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);
            $table->string('name', 50)->nullable();

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('activitycategories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activitycategory_translations');
    }
};
