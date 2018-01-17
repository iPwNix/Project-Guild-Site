<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => 'web'], function () {
    

 Route::get('/', function(){
        if (Auth::check())
        {
        	return redirect('/home');
        } 
        else
        {
          	return view('welcome');
        }
    });
 
});



Route::get('captcha-form-validation',array('as'=>'google.get-recaptcha-validation-form','uses'=>'FileController@getCaptchaForm')) ;
Route::post('captcha-form-validation',array('as'=>'google.post-recaptcha-validation','uses'=>'FileController@postCaptchaForm')) ;


Route::auth();

Route::get('/preapply', function(){
        if (Auth::check())
        {
            if(Auth::user()->siteRole == "8" || Auth::user()->siteRole == "1")
            {
                return redirect('/apply');
            }else{
                return redirect('/home');
            }
        } 
        else{
          	return view('applications/preapply');
        }
});
Route::get('/rules', function(){
        if (Auth::check())
        {
            return view('applications/loggedrules');
        } 
        else{
            return view('applications/nonloggedrules');
        }
    });
Route::get('/about', function(){
    if (Auth::check())
        {
            return view('applications/loggedabout');
        }
        else{
            return view('applications/nonloggedabout');
        }
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/edit/homecarousel/{id}', 'ImageController@editHomeCarousel');
Route::patch('/edit/homecarousel/{id}', 'ImageController@updateHomeCarousel');

Route::get('/apply', 'ApplyController@creating')->name('applycreate');
Route::post('/apply','ApplyController@create')->name('createapply');

Route::get('/application/{id}', 'ApplyController@showApply')->name('showApply');
Route::get('/applications', 'ApplyController@index')->name('allApplys');

Route::get('/application/{id}/accept', 'ApplyController@acceptApply');
Route::get('/application/{id}/decline', 'ApplyController@declineApply');
Route::patch('/application/{id}/accept', 'ApplyController@acceptingApply');
Route::patch('/application/{id}/decline', 'ApplyController@decliningApply');


//Route::get('profile', 'UserController@ownProfile')->name('ownProfile');
Route::get('profile/{id}', 'UserController@showProfile')->name('showProfile');

Route::get('/edit/profile/avatar/{id}', 'UserController@editingAvatar');
Route::post('/edit/profile/avatar/{id}', 'UserController@updateUserAvatar');

Route::get('/edit/profile/{id}', 'UserController@editProfileMain');
Route::patch('/edit/profile/{id}', 'UserController@updateProfileMain');

//Edit Characters
Route::get('/edit/profile/characters/{id}', 'UserController@editProfileCharacters')->name('editCharactersHome');
//Editing Main Character
Route::get('/edit/profile/{userid}/maincharacter/{charid}', 'UserController@editMainCharacter');
Route::patch('/edit/profile/{userid}/maincharacter/{charid}', 'UserController@editingMainCharacter');
//Editing Alt Characters
Route::get('/edit/profile/{userid}/altcharacter/{charid}', 'UserController@editAltCharacter');
Route::patch('/edit/profile/{userid}/altcharacter/{charid}', 'UserController@editingAltCharacter');
//Adding Alt Characters
Route::get('/add/altcharacter/{id}', 'UserController@addAltCharacter');
Route::post('/add/altcharacter/{id}', 'UserController@addingAltCharacter');

Route::delete('/edit/profile/{id}/deletecharacter/{charid}', 'UserController@deletingAltCharacter');

//Editing Profile Cover
Route::get('/edit/profile/cover/{id}', 'UserController@editProfileCover');
Route::post('/edit/profile/cover/{id}', 'UserController@updateUserCover');

Route::get('news', 'NewsController@index');
Route::get('news/create', 'NewsController@creatingNews');
Route::post('news/create', 'NewsController@createNews');
Route::get('news/{id}', 'NewsController@showArticle')->name('showArticle');
Route::get('/edit/newsarticle/{id}', 'NewsController@editArticle');
Route::patch('/edit/newsarticle/{id}', 'NewsController@updateArticle');

Route::get('/userlist', 'UserlistController@index');


Route::get('/adminpanel', 'AdminController@index');
Route::get('/adminpanel/userlist', 'AdminController@userList');

Route::get('/adminpanel/user/rank/{id}', 'AdminController@changeUserRank');
Route::get('/adminpanel/user/ban/{id}', 'AdminController@banUser');
Route::get('/adminpanel/user/unban/{id}', 
                    'AdminController@unbanUser');

Route::patch('/adminpanel/user/rank/{id}', 
    'AdminController@changingUserRank');
Route::patch('/adminpanel/user/ban/{id}', 
    'AdminController@baningUser');
Route::patch('/adminpanel/user/unban/{id}', 'AdminController@unbaningUser');

