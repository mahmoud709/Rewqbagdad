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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50);
            $table->string('email', 30)->unique();
            $table->string('password', 64);

            $table->enum('main', ['normal', 'main'])->default('normal');
            $table->string('info', 255)->nullable();
            $table->string('img', 100)->nullable();
            $table->boolean('is_superadmin')->default(0);
            // $table->bigInteger('group_id')->unsigned();
            // $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
};
