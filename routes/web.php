<?php
use App\Http\Middleware\CheckStatus;

Route::group(array('before' => 'auth'), function() 
{

      Route::get('/compiled', function() {$exitCode = Artisan::call('clear-compiled'); return 'compiled'; });
     
     Route::get('/route', function() {$exitCode = Artisan::call('route:cache'); return 'Routes cache cleared'; });
     Route::get('/config', function() {$exitCode = Artisan::call('config:cache'); return 'Config cache cleared'; });
     Route::get('/cache', function() {$exitCode = Artisan::call('cache:clear'); return 'Application cache cleared'; });
     Route::get('/view', function() {$exitCode = Artisan::call('view:clear'); return 'View cache cleared'; });
     Route::get('/storage-link', function() {$exitCode = Artisan::call('storage:link'); return 'storage link created'; });


});    



//Social Media
Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
Route::get('/callback/{provider}', 'SocialAuthController@callback');

Route::get('/testemail','IndexController@testemail');

Route::get('/','IndexController@index');
Route::get('',['as'=>'posts','uses'=>'IndexController@index']);

Route::prefix('tag')->group(function () {
    Route::get('{tag}','MarkController@index');
    Route::get('{tag}/{uid}','MarkController@show');
});

Route::get('/p/{iuid}', 'IndexController@show');



Route::post('aload','LoadController@aload');
Route::post('selectLanguage', 'IndexController@selectLanguage');

Route::get('/user/{username}', 'IndexController@user');
Route::get('callTagsHints', 'MarkController@callTagsHints');
Route::get('callUserHints', 'MarkController@callUserHints');
Route::get('/image/{iurl}','IndexController@loadImg');


//SIGN IN OR UP
Route::post('/signin_with_account','Auth\LoginController@login');
Route::post('/signup_with_account','Auth\RegisterController@register');
Route::post('/logout','Auth\LoginController@logout');

Route::namespace('Auth')->group(function(){
    
    Route::get('/login','LoginController@showLoginForm')->name('login');
    Route::post('/login','LoginController@login');
    Route::post('/logout','LoginController@logout')->name('logout');
 
    //Forgot Password Routes
    Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    //Reset Password Routes
    Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
});


/*
Route::middleware(['web', 'CheckStatus'])->group(function () {*/
    

//POST
Route::get('/post/new', 'PostController@newPostForm');
Route::post('submitNewPost', 'PostController@submitNewPost');
Route::post('upOrdownVote','PostController@upOrdownVote');


// PFOFILE 
Route::get('/profile', 'AccountController@index');
Route::get('/profile/pending-posts', 'AccountController@MYPendingPosts');
Route::get('/profile/approved-posts', 'AccountController@MYApprovedPosts');
Route::get('/profile/rejected-posts', 'AccountController@MYRejectedPosts');
Route::get('/profile/edit', 'AccountController@editProfileForm');
Route::post('/profile/update', 'AccountController@updateProfile');
Route::get('profile/change-password', 'AccountController@showChangePassword');
Route::post('changePassword', 'AccountController@changePassword');
Route::post('postAboutMe', 'AccountController@postAboutMe');
Route::post('updateUserInfo', 'AccountController@updateUserInfo');
Route::get('ajxHintTags/{keyword?}', 'PostController@ajxHintTags');
Route::post('upAvatarImg', 'AccountController@upAvatarImg');

/*
});*/


//STATIC PAGES
Route::get('/contact-us', 'StaticController@contactus');
Route::post('sendContactEnquiry','StaticController@sendContactEnquiry');

Route::get('/about-us', 'StaticController@aboutus');
Route::get('/privacy-policy', 'StaticController@privacy_policy');
Route::get('/terms-and-conditions', 'StaticController@terms_conditions');
Route::get('/terms-of-service', 'StaticController@terms_of_service');
Route::get('/rules', 'StaticController@rules');
Route::get('/zpp','StaticController@zpp');
Route::get('/sabse-bada-memer-kaun','StaticController@sbmk');



Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
   
    Route::namespace('Auth')->group(function(){
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
        Route::post('/logout','LoginController@logout')->name('logout');
	    Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
       //Reset Password Routes
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
    });

    Route::get('/dashboard','HomeController@index')->name('home');
    Route::get('/contact-enquiry','HomeController@contactEnquiryList');

    Route::get('/tags-list','HomeController@tagList');
    

    
    Route::get('/posts/today','PostController@today');
    Route::get('/posts/this-week','PostController@this_week');
    Route::get('/posts/this-month','PostController@this_month');
    Route::get('/posts/pending','PostController@pending');
    Route::get('/posts/rejected','PostController@rejected');
    Route::get('/posts/approved','PostController@approved');
    
    Route::get('/posts/home','PostController@home');
    Route::get('/post/votes/{id_post}','PostController@votes');
    Route::resource('/posts','PostController');


     //EMPLOYEE
    Route::resource('/employee','AdminController');
    Route::resource('/roles','RoleController');
    Route::get('change-password', 'AdminController@showChangePassword');
    Route::post('changePassword', 'AdminController@changePassword');

  

    Route::get('post_reject_form/{id_post}', 'PostController@postRejectForm');
    Route::post('savePostApproved', 'PostController@savePostApproved');
    Route::post('savePostRejection', 'PostController@savePostRejection');
    
    
    
    //USERS
    Route::get('/users/banned','UserController@banned');
    Route::resource('/users','UserController');
    Route::get('/users/posts/{id_user}','UserController@listUserPosts');
    Route::post('/users/activeOrDisable','UserController@activeOrDisable');

    Route::post('/update_p_stat','PostController@update_p_stat');
    
   
  
});


