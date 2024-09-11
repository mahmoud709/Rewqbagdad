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
        Schema::create('rewaqpublishrule_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);
            $table->text('content')->nullable();
            
            $table->bigInteger('parent_id')->unsigned();
            $table->foreign('parent_id')->references('id')->on('rewaqpublishrules')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewaqpublishrule_translations');
    }
};
