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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);
            $table->enum('main', ['normal', 'main'])->default('normal');
            $table->enum('error_403', ['on', 'off'])->default('on')->nullable();

            $table->enum('home_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('setting_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('setting_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('profile_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('filemanager_show', ['on', 'off'])->default('off')->nullable();


            $table->enum('admin_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('admin_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('admin_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('admin_delete', ['on', 'off'])->default('off')->nullable();

            $table->enum('group_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('group_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('group_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('group_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('backup_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('backup_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('backup_delete', ['on', 'off'])->default('off')->nullable();
            $table->enum('backup_download', ['on', 'off'])->default('off')->nullable();
            $table->enum('backup_restore', ['on', 'off'])->default('off')->nullable();
            
            //////////////////////////////////////////////////////////////////
            $table->enum('about_show', ['on', 'off'])->default('off')->nullable();

            $table->enum('centerteam_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('centerteam_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('centerteam_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('centerteam_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('bookteam_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('bookteam_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('bookteam_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('bookteam_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('versioncategory_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('versioncategory_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('versioncategory_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('versioncategory_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('version_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('version_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('version_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('version_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('activitycategory_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('activitycategory_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('activitycategory_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('activitycategory_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('activity_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('activity_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('activity_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('activity_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('medianews_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('medianews_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('medianews_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('medianews_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('mediaphoto_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('mediaphoto_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('mediaphoto_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('mediaphoto_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('mediavideocategory_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('mediavideocategory_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('mediavideocategory_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('mediavideocategory_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('mediavideo_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('mediavideo_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('mediavideo_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('mediavideo_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('electronic_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('electronic_edit', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('newsletter_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('newsletter_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('rewaqteam_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('rewaqteam_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('rewaqteam_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('rewaqteam_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('rewaqbook_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('rewaqbook_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('rewaqbook_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('rewaqbook_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('rewaqpublishrule_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('rewaq_edit', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('magazineteam_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('magazineteam_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('magazineteam_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('magazineteam_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('magazineblog_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('magazineblog_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('magazineblog_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('magazineblog_delete', ['on', 'off'])->default('off')->nullable();

            $table->enum('magazinerules_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('magazine_edit', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('parliamentvideo_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('parliamentvideo_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('parliamentvideo_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('parliamentvideo_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('iraqmeter_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('iraqmeter_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('iraqmeter_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('iraqmeter_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('events_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('events_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('events_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('events_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('slider_show', ['on', 'off'])->default('off')->nullable();
            $table->enum('slider_create', ['on', 'off'])->default('off')->nullable();
            $table->enum('slider_edit', ['on', 'off'])->default('off')->nullable();
            $table->enum('slider_delete', ['on', 'off'])->default('off')->nullable();
            
            $table->enum('parliament_edit', ['on', 'off'])->default('off')->nullable();
            
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
        Schema::dropIfExists('groups');
    }
};
