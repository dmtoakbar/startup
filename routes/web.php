<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OfficeAdminController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\QuestionPaperController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SiteHomePageController;
use App\Http\Controllers\SiteIndexPageController;
use App\Http\Controllers\StudentUserController;
use App\Http\Controllers\StudentDashboard;
use App\Http\Controllers\OfficeStudentController;
use App\Http\Controllers\OfficePaymentSetup;
use App\Http\Controllers\OfficeDigestController;
use App\Http\Controllers\OfficeJobController;


// site routes
Route::get('/', [SiteIndexPageController::class, 'index'])->name('site-home');
Route::get('/test-collection/{id?}', [SiteIndexPageController::class, 'testCollection'])->name('site-test-collection');
Route::get('/test-collection/particular/{id?}', [SiteIndexPageController::class, 'testCollectionParticular'])->name('site-test-collection-particular');


//  end site routes

// student dashboard
Route::prefix('student/dashboard')
->controller(StudentDashboard::class)
->group(function () {
   Route::match(['get', 'post'], '/', 'dashboard')->name('student-dashboard');
});

// end student dashboard

// user
Route::match(['get', 'post'], 'user/register', [StudentUserController::class, 'register'])->name('user-register');
Route::match(['get', 'post'], '/user/register/otp-validate', [StudentUserController::class, 'validateUserOtp'])->name('validate-user-otp');
Route::match(['get', 'post'], '/user/login', [StudentUserController::class, 'login'])->name('user-login');
Route::match(['get', 'post'], '/user/forget-password', [StudentUserController::class, 'forgetPassword'])->name('user-forget-password');
Route::match(['get', 'post'], '/user/forget-password-form', [StudentUserController::class, 'forgetPasswordForm'])->name('user-forget-password-form');

Route::match(['get', 'post'], '/user/exam/intro/first/{id?}', [StudentUserController::class, 'examIntroFirst'])->name('user-exam-intro-first');
Route::match(['get', 'post'], '/user/exam/intro/second/{id?}', [StudentUserController::class, 'examIntroSecond'])->name('user-exam-intro-second');
Route::match(['get', 'post'], '/user/exam/attempt/{id?}', [StudentUserController::class, 'examAttempt'])->name('user-exam-attempt');
Route::match(['get', 'post'], '/user/exam/submit', [StudentUserController::class, 'examSubmit'])->name('user-exam-submit');
// end user

// clear cache
Route::get('application/cache/clear', [OfficeAdminController::class, 'applicationCacheClear'])->name('clear-all-cache')->middleware('clearCacheInfo');
// end clear cache

// open route for verify admin email, login and password reset
Route:: prefix('admin')
 ->controller(OfficeAdminController::class)
 ->group(function(){
    Route::match(['get', 'post'], '/login', 'adminLogin')->name('admin-login')->middleware('ensureAdminLogout');
    Route::get('/verify/email/{id}/{key}', 'verifyEmail')->name('admin-verify-email');
    Route::match(['get', 'post'], '/resend/email/verify/link', 'resendEmailVerifyLink')->name('admin-resend-email-verify-link');
    Route::match(['get', 'post'], '/forget-password', 'forgetPassword')->name('admin-forget-password');
    Route::match(['get', 'post'], '/password/forget/link/{id?}/{key?}', 'passwordForgetLinkVerify')->name('admin-forget-password-link-verify');
 });


Route::prefix('office/')
->middleware(['ensureAdminLogged', 'restrictAdminUser'])
->group(function () {
   // ----------------------------- office admin home page --------------------------------
  Route::prefix('admin')
  ->controller(OfficeAdminController::class)
  ->group(function(){
   Route::get('/','index')->name('office-admin')->middleware('clearCacheInfo');
   Route::get('/admin-user','adminUser')->name('office-admin-user');
   Route::match(['get', 'post'], '/admin-user/add','adminUserAdd')->name('office-admin-user-add');
   Route::get('/logout', 'adminLogOut')->name('office-admin-logout')->middleware('clearCacheInfo');
   Route::match(['get', 'post'], '/change/admin/user/status/{email?}', 'changeAdminUserStatus')->name('office-admin-user-status');
   Route::match(['get', 'post'], '/change/admin/user/type/{email?}', 'changeAdminUserType')->name('office-admin-user-type');
   Route::get('/show/detail/{detail}/{name}', 'showAdminDetail')->name('office-admin-detail');
   Route::post('delete/admin/user', 'deleteAdminUser')->name('office-admin-user-delete');
   Route::post('/fill/admin/profile/data', 'fillAdminProfileData')->name('office-admin-fill-profile');
   Route::match(['get', 'post'], '/change/admin/user/department/{email?}', 'adminUserDeparmentUpdate')->name('office-admin-user-department');
  });
 //---------------------------------- end office admin home page -----------------------------
 //-----------------------------------office student user page ----------------------------------
 Route::prefix('student')
  ->controller(OfficeStudentController::class)
  ->group(function(){
   Route::get('/','index')->name('office-student');
   Route::match(['get', 'post'], '/change/student/user/status/{email?}', 'changeStatus')->name('office-student-user-status');
   Route::get('/show/user/detail/{detail}', 'showUserDetail')->name('office-user-detail');
   
  });
 //------------------------------------end office student user page ------------------------------
  // ----------------------------- office admin service name page --------------------------------
  Route::prefix('services')
  ->controller(ServiceController::class)
  ->group(function(){
      Route::get('/', 'index')->name('office-services');
      Route::match(['get', 'post'], '/add', 'add')->name('office-services-add');
      Route::match(['get', 'post'], '/edit/{id?}', 'edit')->name('office-services-edit');
      Route::post('/delete', 'delete')->name('office-services-delete');
      Route::post('/status/change', 'changeStatus')->name('office-services-change-status');
  });
 //---------------------------------- end office admin service name page -----------------------------
  // ----------------------------- office admin test name page --------------------------------
  Route::prefix('tests')
  ->controller(TestController::class)
  ->group(function(){
      Route::get('/', 'index')->name('office-tests');
      Route::match(['get', 'post'], '/add', 'add')->name('office-tests-add');
      Route::match(['get', 'post'], '/edit/{id?}', 'edit')->name('office-tests-edit');
      Route::post('/delete', 'delete')->name('office-tests-delete');
      Route::post('/status/change', 'changeTestStatus')->name('office-tests-status');
  });
 //---------------------------------- end admin test name page -----------------------------
  // ----------------------------- office admin subject name page --------------------------------
  Route::prefix('subjects')
  ->controller(SubjectController::class)
  ->group(function(){
      Route::get('/', 'index')->name('office-subjects');
      Route::match(['get', 'post'], '/add', 'add')->name('office-subjects-add');
      Route::match(['get', 'post'], '/edit/{id?}', 'edit')->name('office-subjects-edit');
      Route::post('/delete', 'delete')->name('office-subjects-delete');
      Route::post('/status/change', 'changeStatus')->name('office-subjects-status');
  });
 //---------------------------------- end admin subject name page -----------------------------
  // ----------------------------- office admin questions paper page --------------------------------
  Route::prefix('questionpaper')
  ->controller(QuestionPaperController::class)
  ->group(function(){
      Route::get('/', 'index')->name('office-questionpaper');
      Route::match(['get', 'post'], '/add', 'add')->name('office-questionpaper-add');
      Route::match(['get', 'post'], '/edit/{id?}', 'edit')->name('office-questionpaper-edit');
      Route::post('/delete', 'delete')->name('office-questionpaper-delete');
      Route::post('/status/change', 'changeStatus')->name('office-questionpaper-status');
      Route::post('/set-payment', 'setPayment')->name('office-questionpaper-set-payment');
      Route::match(['get', 'post'], '/question/{id?}', 'question')->name('office-questionpaper-question');
      Route::match(['get', 'post'], '/question/add/{id?}', 'addQuestion')->name('office-questionpaper-question-add');
      Route::match(['get', 'post'], '/question/edit/{id?}', 'editQuestion')->name('office-question-edit');
      Route::post('/question/delete/one', 'delQuestionOne')->name('office-question-delete');
  });
 //---------------------------------- end admin questions paper page -----------------------------
 // ----------------------------- office admin job paper page --------------------------------
 Route::prefix('job')
 ->controller(OfficeJobController::class)
 ->group(function(){
     Route::get('/', 'jobTag')->name('office-job-tag');
     Route::match(['post', 'put'], '/tag/add/and/edit', 'tagJobAddAndEdit')->name('office-job-tag-add-and-edit');
     Route::post('/tag/status/change', 'changeJobTagStatus')->name('office-job-tag-status');
     Route::delete('/tag/delete', 'deleteJobTag')->name('office-job-tag-delete');
     Route::get('/content', 'jobContent')->name('office-job-content');
     Route::match(['post', 'get'], '/content/add', 'jobContentAdd')->name('office-job-content-add');
     Route::match(['get', 'post'], '/content/content/edit/{id?}', 'jobContentEdit')->name('office-job-content-edit');
     Route::post('/content/status/change', 'changeJobContentStatus')->name('office-job-content-status');
     Route::delete('/content/delete', 'deleteJobContent')->name('office-job-content-delete');
     Route::match(['get', 'post'], '/content/content/copy/{id?}', 'jobContentCopy')->name('office-job-content-copy');
     Route::get('/content/preview/{id}/{title}', 'jobContentPreview')->name('office-job-content-preview');
 });
//---------------------------------- end admin job paper page -----------------------------
 // ----------------------------- office digest controller --------------------------------
 Route::prefix('digest')
  ->controller(OfficeDigestController::class)
  ->group(function(){
      Route::get('/', 'index')->name('office-digest-tag');
      Route::match(['post', 'put'], '/tag/add/and/edit', 'tagAddAndEdit')->name('office-digest-tag-add-and-edit');
      Route::delete('/tag/delete', 'deleteTag')->name('office-tag-delete');
      Route::post('/tag/status/change', 'changeTagStatus')->name('office-tag-status');
      Route::get('/sub-tag', 'indexSubTag')->name('office-digest-sub-tag');
      Route::match(['post', 'put'], '/sub/tag/add/and/edit', 'subTagAddAndEdit')->name('office-digest-sub-tag-add-and-edit');
      Route::post('/sub/tag/status/change', 'changeSubTagStatus')->name('office-sub-tag-status');
      Route::delete('/sub/tag/delete', 'deleteSubTag')->name('office-sub-tag-delete');
      Route::get('/content', 'indexDigest')->name('office-digest-content');
      Route::match(['get', 'post'], '/content/add', 'addDigestContent')->name('office-digest-content-add');
      Route::match(['get', 'post'], '/content/edit/{id?}', 'editDigestContent')->name('office-digest-content-edit');
      Route::post('/content/status/change', 'changeDigestContentStatus')->name('office-digest-content-status');
      Route::delete('/content/delete', 'deleteDigestContent')->name('office-digest-content-delete');
      Route::get('/content/preview/{id}/{title}', 'digestContentPreview')->name('office-digest-content-preview');
  });
 //---------------------------------- end office digest controller -----------------------------
 // ----------------------------- office payment setup page --------------------------------
 Route::prefix('payment-setup')
  ->controller(OfficePaymentSetup::class)
  ->group(function(){
      Route::get('/', 'index')->name('office-payment');
      Route::match(['get', 'post'], '/add', 'add')->name('office-payment-add');
      Route::match(['get', 'post'], '/edit/{id}', 'edit')->name('office-payment-edit');
      Route::post('/delete', 'delete')->name('office-payment-delete');
      Route::Post('/coupon', 'coupon')->name('office-payment-coupon');
  });
 //---------------------------------- end office payment setup page -----------------------------

});
// office admin section



// site home page
Route::get('office/site-home-page', [SiteHomePageController::class, 'index'])->name('office-site-home-page');
Route::get('office/site-home-page/content-name', [SiteHomePageController::class, 'homeContentName'])->name('office-site-home-page-content-name');
Route::match(['get', 'post'],'office/site-home-page/content-name/add', [SiteHomePageController::class, 'homeContentNameAdd'])->name('office-site-home-page-content-name-add');
Route::match(['get', 'post'],'office/site-home-page/content-name/edit/{id?}', [SiteHomePageController::class, 'homeContentNameEdit'])->name('office-site-home-page-content-name-edit');
Route::post('office/site-home-page/content-name/delete', [SiteHomePageController::class, 'homeContentNameDelete'])->name('office-site-home-page-content-name-delete');
Route::get('office/site-home-page/carousel', [SiteHomePageController::class, 'carousel'])->name('office-site-home-page-carousel');
Route::match(['get', 'post'],'office/site-home-page/carousel/add', [SiteHomePageController::class, 'carouselAdd'])->name('office-site-home-page-carousel-add');
Route::match(['get', 'post'],'office/site-home-page/carousel/edit/{id?}', [SiteHomePageController::class, 'carouselEdit'])->name('office-site-home-page-carousel-edit');
Route::post('office/site-home-page/carousel/delete', [SiteHomePageController::class, 'carouselDelete'])->name('office-site-home-page-carousel-delete');

// end
// end office admin section