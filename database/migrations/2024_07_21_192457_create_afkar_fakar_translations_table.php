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
        Schema::create('afkar_fakar_translations', function (Blueprint $table) {
            $table->id();
            
            $table->string('locale', 5);

            $table->string('name', 200)->nullable();

            $table->text('description')->nullable();

            $table->bigInteger('afkar_fakar_id')->unsigned();

            $table->foreign('afkar_fakar_id')->references('id')
            ->on('afkar_fakars')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('afkar_fakar_translations');
    }
};
