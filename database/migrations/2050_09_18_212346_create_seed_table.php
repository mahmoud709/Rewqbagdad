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
        DB::table('settings')->insert([
            [
                'phone' => '00201021464469',
                'email' => 'thebeststory0@gmail.com',
                'contact_email' => 'thebeststory0@gmail.com',
                'logo_header' => '/admin/demo.svg',
                'logo_footer' => '/admin/demo.svg',
                'icon' => '/admin/demo.svg',
                'facebook' => 'https://www.facebook.com/alnefelys',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('setting_translations')->insert([
            [
                'locale' => 'ar',
                'name' => 'اسم الموقع',
                'description' => 'وصف الموقع',
                'address' => 'مصر',
                'setting_id' => 1,
            ],
            [
                'locale' => 'en',
                'name' => 'Site Name',
                'description' => 'Site description',
                'address' => 'Egypt',
                'setting_id' => 1,
            ],
        ]);
        // |||||||||||||||||||||||||||||||||||||||||||||
        DB::table('groups')->insert([
            [
                'name'=>'Full Permissions',
                'main'=>'main',
                'created_at'=>now(),

                'admin_show' => 'on',
                'admin_create' => 'on',
                'admin_edit' => 'on',
                'admin_delete' => 'on',

                'group_show' => 'on',
                'group_create' => 'on',
                'group_edit' => 'on',
                'group_delete' => 'on',
                
                'backup_show' => 'on',
                'backup_create' => 'on',
                'backup_delete' => 'on',
                'backup_download' => 'on',
                'backup_restore' => 'on',
                'home_show' => 'on',
                'setting_show' => 'on',
                'setting_edit' => 'on',
                'profile_edit' => 'on',
                'filemanager_show' => 'on',
                //////////////////////

                'about_show' => 'on',

                'centerteam_show' => 'on',
                'centerteam_create' => 'on',
                'centerteam_edit' => 'on',
                'centerteam_delete' => 'on',
                
                'bookteam_show' => 'on',
                'bookteam_create' => 'on',
                'bookteam_edit' => 'on',
                'bookteam_delete' => 'on',
                
                'versioncategory_show' => 'on',
                'versioncategory_create' => 'on',
                'versioncategory_edit' => 'on',
                'versioncategory_delete' => 'on',
                
                'version_show' => 'on',
                'version_create' => 'on',
                'version_edit' => 'on',
                'version_delete' => 'on',
                
                'activitycategory_show' => 'on',
                'activitycategory_create' => 'on',
                'activitycategory_edit' => 'on',
                'activitycategory_delete' => 'on',
                
                'activity_show' => 'on',
                'activity_create' => 'on',
                'activity_edit' => 'on',
                'activity_delete' => 'on',
                
                'medianews_show' => 'on',
                'medianews_create' => 'on',
                'medianews_edit' => 'on',
                'medianews_delete' => 'on',
                
                'mediaphoto_show' => 'on',
                'mediaphoto_create' => 'on',
                'mediaphoto_edit' => 'on',
                'mediaphoto_delete' => 'on',
                
                'mediavideocategory_show' => 'on',
                'mediavideocategory_create' => 'on',
                'mediavideocategory_edit' => 'on',
                'mediavideocategory_delete' => 'on',
                
                'mediavideo_show' => 'on',
                'mediavideo_create' => 'on',
                'mediavideo_edit' => 'on',
                'mediavideo_delete' => 'on',
                
                
                'electronic_show' => 'on',
                'electronic_edit' => 'on',
                
                'newsletter_show' => 'on',
                'newsletter_delete' => 'on',
                
                'rewaqteam_show' => 'on',
                'rewaqteam_create' => 'on',
                'rewaqteam_edit' => 'on',
                'rewaqteam_delete' => 'on',
                
                'rewaqbook_show' => 'on',
                'rewaqbook_create' => 'on',
                'rewaqbook_edit' => 'on',
                'rewaqbook_delete' => 'on',
                
                'magazineteam_show' => 'on',
                'magazineteam_create' => 'on',
                'magazineteam_edit' => 'on',
                'magazineteam_delete' => 'on',
                
                'magazineblog_show' => 'on',
                'magazineblog_create' => 'on',
                'magazineblog_edit' => 'on',
                'magazineblog_delete' => 'on',
                
                'parliamentvideo_show' => 'on',
                'parliamentvideo_create' => 'on',
                'parliamentvideo_edit' => 'on',
                'parliamentvideo_delete' => 'on',
                
                'iraqmeter_show' => 'on',
                'iraqmeter_create' => 'on',
                'iraqmeter_edit' => 'on',
                'iraqmeter_delete' => 'on',
                
                'events_show' => 'on',
                'events_create' => 'on',
                'events_edit' => 'on',
                'events_delete' => 'on',
                
                'slider_show' => 'on',
                'slider_create' => 'on',
                'slider_edit' => 'on',
                'slider_delete' => 'on',
                
                'parliament_edit' => 'on',
                'magazinerules_edit' => 'on',
                'rewaqpublishrule_edit' => 'on',
                'magazine_edit' => 'on',
                'rewaq_edit' => 'on',
            ],
        ]);
        // |||||||||||||||||||||||||||||||||||||||||||||
        DB::table('parliaments')->insert([
            [
                'img' => '/admin/demo.svg',
                'google_url' => 'https://google.com',
                'apple_url' => 'https://google.com',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
        DB::table('parliament_translations')->insert([
            [
                'locale' => 'ar',
                'title' => 'انا البرلمان',
                'content' => 'تطبيق الكتروني متطور تم استحداثه بدعم من مؤسسة كونراد',
                'description' => 'يمكننكم تحميل التطبيق من متاجر التطبيقات متوفر لاجهزة الايفون والاندرويد. ويمكنكم ايضا زيارة موقع انا البرلمان',
                'parent_id' => 1,
            ],
            [
                'locale' => 'en',
                'title' => 'I am Parliament',
                'content' => 'content en',
                'description' => 'description en',
                'parent_id' => 1,
            ],
        ]);
        DB::table('magazinerules')->insert([
            [
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
        DB::table('magazinerules_translations')->insert([
            [
                'locale'=>'ar',
                'content'=>'content ar',
                'parent_id'=>1,
            ],
            [
                'locale'=>'en',
                'content'=>'content en',
                'parent_id'=>1,
            ],
        ]);

        DB::table('rewaqteams')->insert([
            [
                'type' => '/admin/demo.svg',
                'email' => 'thebeststory0@gmail.com',
                'type' => 'pm',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
        DB::table('rewaqteam_translations')->insert([
            [
                'locale' => 'ar',
                'name' => 'عبدالرحمن محمد',
                'job_title' => 'مدير المشروع',
                'rewaq_id' => 1,
            ],
            [
                'locale' => 'en',
                'name' => 'Abdelrahman Mohamed',
                'job_title' => 'Project Manager',
                'rewaq_id' => 1,
            ],
        ]);

        DB::table('magazines')->insert([
            [
                'img' => '/admin/demo.svg',
                'contact_email' => 'thebeststory0@gmail.com',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
        
        DB::table('magazine_translations')->insert([
            [
                'locale' => 'ar',
                'content' => 'content ar',
                'parent_id'=>1,
            ],
            [
                'locale' => 'en',
                'content' => 'content en',
                'parent_id'=>1,
            ],
        ]);

        DB::table('rewaqs')->insert([
            [
                'img' => '/admin/demo.svg',
                'contact_email' => 'thebeststory0@gmail.com',
                'pm_id' => 1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
        DB::table('rewaq_translations')->insert([
            [
                'locale'=>'ar',
                'content'=>'content ar',
                'parent_id'=>1,
            ],
            [
                'locale'=>'en',
                'content'=>'content en',
                'parent_id'=>1,
            ],
        ]);

        DB::table('rewaqpublishrules')->insert([
            [
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
        DB::table('rewaqpublishrule_translations')->insert([
            [
                'locale'=>'ar',
                'content'=>'content ar',
                'parent_id'=>1,
            ],
            [
                'locale'=>'en',
                'content'=>'content en',
                'parent_id'=>1,
            ],
        ]);

        DB::table('admins')->insert([
            [
                'name'=>'Abdo Mohamed',
                'email'=>'admin@admin.com',
                'password'=> bcrypt(123456),
                'img'=>'/admin/demo.svg',
                'main'=>'main',
                'is_superadmin'=>1,
                'email_verified_at'=>now(),
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
        // |||||||||||||||||||||||||||||||||||||||||||||
        DB::table('abouts')->insert([
            [
                'img1'=>'/admin/demo.svg',
                'img2'=>'/admin/demo.svg',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
        DB::table('about_translations')->insert([
            [
                'locale'=> 'ar',
                'description'=> 'وصف',
                'about_id'=> 1,
            ],
            [
                'locale'=> 'en',
                'description'=> 'description',
                'about_id'=> 1,
            ],
        ]);
        DB::table('about_data')->insert([
            [
                'type'=> 'targets',
                'content_ar'=> 'targets ar',
                'content_en'=> 'targets en',
                'about_id'=> 1,
            ],
            //
            [
                'type'=> 'vision',
                'content_ar'=> 'vision ar',
                'content_en'=> 'vision en',
                'about_id'=> 1,
            ],
            //
            [
                'type'=> 'means',
                'content_ar'=> 'means ar',
                'content_en'=> 'means en',
                'about_id'=> 1,
            ],
        ]);
        DB::table('teamsettings')->insert([
            [
                'slug'=> 'book-team',
                'description_ar'=> 'description ar',
                'description_en'=> 'description en',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'slug'=> 'center-team',
                'description_ar'=> 'description ar',
                'description_en'=> 'description en',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
        DB::table('electronicservices')->insert([
            [
                'slug'  => 'visit-center',
                'email' => 'thebeststory0@gmail.com',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'slug'  => 'request-survey',
                'email' => 'thebeststory0@gmail.com',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'slug'  => 'request-host-event',
                'email' => 'thebeststory0@gmail.com',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'slug'  => 'membership-request',
                'email' => 'thebeststory0@gmail.com',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'slug'  => 'request-invitation',
                'email' => 'thebeststory0@gmail.com',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ]);
        DB::table('electronicservice_translations')->insert([
            [
                'locale'=> 'ar',
                'description'=> 'description_ar',
                'title' => 'طلب زيارة المركز',
                'content'=> null,
                'electronic_id'=> 1, 
            ],
            [
                'locale'=> 'en',
                'description'=> 'description_en',
                'title' => 'Request to visit the center',
                'content'=> null,
                'electronic_id'=> 1, 
            ],
            [
                'locale'=> 'ar',
                'description'=> 'description_ar',
                'title' => 'طلب استطلاع رأي',
                'content'=> 'content ar',
                'electronic_id'=> 2, 
            ],
            [
                'locale'=> 'en',
                'description'=> 'description_en',
                'title' => 'Request a survey',
                'content'=> 'content en',
                'electronic_id'=> 2, 
            ],
            [
                'locale'=> 'ar',
                'description'=> 'description_ar',
                'title' => 'طلب استضافة فعالية',
                'content'=> null,
                'electronic_id'=> 3, 
            ],
            [
                'locale'=> 'en',
                'description'=> 'description_en',
                'title' => 'Request to host an event',
                'content'=> null,
                'electronic_id'=> 3, 
            ],
            [
                'locale'=> 'ar',
                'description'=> 'description_ar',
                'title' => 'طلب عضوية',
                'content'=> null,
                'electronic_id'=> 4, 
            ],
            [
                'locale'=> 'en',
                'description'=> 'description_en',
                'title' => 'Membership request',
                'content'=> null,
                'electronic_id'=> 4, 
            ],
            [
                'locale'=> 'ar',
                'description'=> 'description_ar',
                'title' => 'طلب دعوة للنشر او المشاركة البحثية',
                'content'=> null,
                'electronic_id'=> 5, 
            ],
            [
                'locale'=> 'en',
                'description'=> 'description_en',
                'title' => 'Request an invitation to publish or research participation',
                'content'=> null,
                'electronic_id'=> 5, 
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seed');
    }
};
