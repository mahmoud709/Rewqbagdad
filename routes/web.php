<?php

use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FaqController;
use App\Http\Controllers\OurvisionController;
use App\Http\Controllers\Front\MedadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::pattern('tag', '.*');

Route::group(['namespace' => 'Front'], function(){

    Route::get('/', 'IndexController@index');
    Route::get('/search', 'IndexController@search');

    Route::post('/get/writer/version', 'AjaxController@getWriterVersion');

    Route::get('/event/{tag}', 'IndexController@ShowEvent');

    Route::post('/get/events', 'IndexController@GetEvents');
    Route::get('/contact-us', 'AboutController@ContactUs');
    Route::post('/contact-us', 'AboutController@sendMail');

    Route::get('/about-us', 'AboutController@AboutUs');
    Route::get('/employee/center', 'AboutController@EmployeeCenter');
    Route::get('/center/writers', 'AboutController@CenterWriters');


    Route::get('/versions/category/{slug}', 'VersionController@category');
    Route::get('/version/tag/{tag}', 'VersionController@Tag');
    Route::get('/versions', 'VersionController@All');
    Route::get('/version/{slug}', 'VersionController@SingleVersion');


    Route::get('/activities/category/{slug}', 'ActivityController@category');
    Route::get('/activities/tag/{tag}', 'ActivityController@Tag');
    Route::get('/activities', 'ActivityController@All');
    Route::get('/activity/{slug}', 'ActivityController@SingleActivity');


    Route::get('/rewaq', 'RewaqController@index');
    Route::get('/rewaq/videos', 'RewaqController@videos')->name('rewaq.videos');
    Route::post('/rewaq/contact', 'MailController@rewaqContactUs')->name('rewaq.contact');
    Route::get('/rewaq/book/{slug}', 'RewaqController@book');
    Route::get('/rewaq/book/tag/{tag}', 'RewaqController@Tag');
    Route::get('/rewaq/versions', 'RewaqController@versions')->name('rewaq.versions');

    Route::get('/rewaq/publish/role', 'RewaqController@PublishRole');
    Route::get('/rewaq/editorial-board', 'RewaqController@EditorialBoard');
    Route::get('/rewaq/contact-us', 'RewaqController@contact');
    Route::post('/rewaq/contact-us', 'RewaqController@sendMail');

    Route::get('/rewaq/booking-book/{slug}', 'RewaqController@reserveBook')->name('rewaq.bookingBook');
    Route::post('/rewaq/reserve-book/', 'MailController@reserveBook')->name('rewaq.mail.bookingBook');

    Route::get('/magazine-rewaq/booking-book/{slug}', 'MagazineController@reserveBook')->name('magazine-rewaq.bookingBook');
    Route::post('/magazine-rewaq/reserve-book/', 'MailController@magazineRewaqReserveBook')->name('magazine.rewaq.mail.bookingBook');

    Route::get('/magazine', 'MagazineController@index');
    Route::get('/magazine/blog/{slug}', 'MagazineController@SingleMagazine');
    Route::get('/magazine/tag/{tag}', 'MagazineController@Tag');
    Route::get('/magazine/publish/role', 'MagazineController@PublishRole');
    Route::get('/magazine/editorial-board', 'MagazineController@EditorialBoard');
    Route::get('/magazine/contact-us', 'MagazineController@contact');
    Route::post('/magazine/contact-us', 'MagazineController@sendMail');

    Route::get('/khetab-magazine', 'KhetabMagazineController@index');
    Route::get('/khetab-magazine/blog/{slug}', 'KhetabMagazineController@SingleMagazine')->name('khetab.magazine.blog');
    Route::get('/khetab-magazine/tag/{tag}', 'KhetabMagazineController@Tag');
    Route::get('/khetab-magazine/publish/role', 'KhetabMagazineController@PublishRole');
    Route::get('/khetab-magazine/editorial-board', 'KhetabMagazineController@EditorialBoard');
    Route::get('/khetab-magazine/contact-us', 'KhetabMagazineController@contact');
    Route::post('/khetab-magazine/contact-us', 'KhetabMagazineController@sendMail');
    Route::get('/khetab-magazine/booking-book/{slug}', 'KhetabMagazineController@reserveBook')->name('khetab.bookingBook');
    Route::post('/khetab-magazine/reserve-book/', 'MailController@khetabReserveBook')->name('khetab.mail.bookingBook');

    Route::get('/MEJEELP-magazine', 'MEJEELPController@index');
    Route::get('/MEJEELP-magazine/blog/{slug}', 'MEJEELPController@SingleMagazine');
    Route::get('/MEJEELP-magazine/tag/{tag}', 'MEJEELPController@Tag');
    Route::get('/MEJEELP-magazine/publish/role', 'MEJEELPController@PublishRole');
    Route::get('/MEJEELP-magazine/editorial-board', 'MEJEELPController@EditorialBoard');
    Route::get('/MEJEELP-magazine/contact-us', 'MEJEELPController@contact');
    Route::post('/MEJEELP-magazine/contact-us', 'MEJEELPController@sendMail');
    Route::get('/MEJEELP-magazine/booking-book/{slug}', 'MEJEELPController@reserveBook')->name('mejeelp.bookingBook');
    Route::post('/MEJEELP-magazine/reserve-book/', 'MailController@mejeelpReserveBook')->name('mejeelp.mail.bookingBook');


    Route::get('/parliament', 'ParliamentController@index');



    Route::get('/kon-media/center/news', 'KonMediaController@news');
    Route::get('/kon-media/center/news/{slug}', 'KonMediaController@SingleNews');
    Route::get('/kon-media/center/news/tag/{tag}', 'KonMediaController@Tag');


  

    Route::get('/iraq/meter', 'IraqmeterController@Info');
    Route::get('/iraq/meter/blogs', 'IraqmeterController@blogs');
    Route::get('/iraq/meter/{slug}', 'IraqmeterController@SingleBlog');
    Route::get('/iraq/meter/surveydetails/{slug}', 'IraqmeterController@serveyDetails')->name('iraqmeter.serveyDetails');
    Route::get('/iraq-meter/all-survey', 'IraqmeterController@allsurvey')->name('iraqmeter.allsurvey');
    Route::get('/iraq/meter/tag/{tag}', 'IraqmeterController@Tag');

    Route::get('/iraqmeter/booking-book/{slug}', 'IraqmeterController@reserveBook')->name('iraq.bookingBook');


   

    Route::get('/boadcast', 'IraqmeterController@boadcast');
    Route::get('/boadcast/details', 'IraqmeterController@boadcastDetails');
    Route::get('/boadcast/ourepisodes', 'IraqmeterController@ourEpisodes')->name('bodcast.ourEpisodes');
    Route::get('/boadcast/afkarfakar', 'IraqmeterController@afkarFakar')->name('bodcast.afkarFakar');
    Route::get('/boadcast/blog-details/{slug}', 'IraqmeterController@boadcastBlogDetails')->name('bodcast.blog-details');
    Route::get('/boadcast/blogs/', 'IraqmeterController@bodcastBlogs')->name('bodcast.blogs');
    Route::post('/bodcast-contactus', 'MailController@contactUsBodcast')->name('bodcast.contactus');
    Route::get('/kon', 'IraqmeterController@kon');
    Route::get('/kon/all', 'IraqmeterController@allKon')->name('kon.allKon');
    Route::get('/kon/trainingdetails/{slug}', 'IraqmeterController@trainingDetails')->name('kon.trainingDetails');
    Route::get('/kon/upcommingtrainingdetails/{slug}', 'IraqmeterController@upcommingTrainingDetails')->name('kon.upcommingTrainingDetails');
    Route::get('/kon/allUpcommingTrainings', 'IraqmeterController@allUpcommingTrainings')->name('kon.allUpcommingTrainings');
    Route::post('/kon/request-training', 'MailController@RequestTraining')->name('kon.RequestTraining');
    Route::get('/kon/videos', 'IraqmeterController@konVideos')->name('kon.videos');
    Route::post('/iraqmeter/request-questionnaire', 'MailController@requestQuestionnaire')->name('iraqmeter.requestQuestionnaire');

    Route::get('/media/center/news', 'MediacenterController@news');
    Route::get('/media/center/news/{slug}', 'MediacenterController@SingleNews');
    Route::get('/media/center/news/tag/{tag}', 'MediacenterController@Tag');


    Route::get('/media/center/gallery', 'MediacenterController@Gallery');
    Route::get('/media/center/videos', 'MediacenterController@videos');


    Route::get('/visit-center', 'ElectronicController@VisitCenter');
    Route::post('/visit-center', 'ElectronicController@VisitCenterSendMail');

    Route::get('/request-survey', 'ElectronicController@RequestSurvey');

    Route::post('/request-survey', 'ElectronicController@RequestSurveySendMail');
   

    Route::get('/request-host-event', 'ElectronicController@RequestHost');
    Route::post('/request-host-event', 'ElectronicController@RequestHostSendMail');

    Route::get('/membership-request', 'ElectronicController@MembershipRequest');
    Route::post('/membership-request', 'ElectronicController@MembershipRequestSendMail');

    Route::get('/request-invitation', 'ElectronicController@RequestInvitation');
    Route::post('/request-invitation', 'ElectronicController@RequestInvitationSendMail');
    Route::get('/faq', 'FaqController@faq');
    Route::get('/ourvision ', 'OurvisionController@ourvision')->name('ourvision');
    Route::get('/medad ', 'MedadController@index')->name('medad');
    Route::post('/medad/request-publish', 'MailController@requestPublish')->name('medad.request.publish');
    Route::get('/etmam', 'EtmamController@index')->name('etmam');
    Route::post('/etmam/request-event', 'MailController@requestEvent')->name('etmam.requestEvent');
    Route::get('/etmam/{slug}', 'EtmamController@SingleEtmam');
    Route::get('/all-etmam', 'EtmamController@All');
  

});



Route::post('/subscription', 'Front\IndexController@subscription');
Route::get('/active/subscription', 'Admin\NewsletterController@active');

// Route::get('/ourvision ', 'OurvisionController@ourvision')->name('ourvision');

Route::group(['prefix' => 'filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

