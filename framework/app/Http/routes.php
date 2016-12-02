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


Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/home', 'HomeController@index');



Route::get('/form', function() {
    return View::make('form');
});

Route::get('/form1', function() {
    return View::make('form1');
});

Route::group(['middleware' => ['web']], function () {
    Route::post('/register', 'MemberAuth\AuthMemberController@postRegister');
    Route::get('/', 'FrontController@index');
    Route::get('/login', 'MemberAuth\AuthMemberController@getLogin');
    Route::post('/login', 'MemberAuth\AuthMemberController@postLogin');
    Route::get('/register', 'MemberAuth\AuthMemberController@getRegister');
});

//Login-Line
Route::get('/line-login', 'FrontController@lineLogin');
Route::get('/line2016', 'FrontController@lineLoginGet');

//DropZone
Route::get('/dropzone', 'MemberController@dropZone');



//Member
Route::group(['middleware' => ['web', 'member']], function () {
    Route::get('/profile/{username}', 'MemberController@index');
    Route::get('/profile/{username}/edit', 'MemberController@editProfile');
//    Route::get('/', 'MemberController@index');
    Route::get('/profile/{username}/logout', 'MemberAuth\AuthMemberController@getLogout');
    Route::get('/profile/{username}/getDownload/{file}', 'MemberAuth\AuthMemberController@getDownload');
    //Uji coba
    Route::get('profile/{username}/panel', 'MemberController@panel');
    Route::post('profile/{username}/panel', 'MemberController@postPanel');
    // Quiz
    Route::get('profile/{username}/panel/quiz', 'MemberController@tryOut');
    Route::post('profile/{username}/panel/quiz', 'MemberController@tryOut');
    //tryOut
    Route::get('profile/{username}/panel/tryOut', 'MemberController@tryOut');
    Route::post('profile/{username}/panel/tryOut', 'MemberController@tryOut');
    Route::get('profile/{username}/panel/tryOut/finish', 'MemberController@tryOutFinish');
    Route::post('/member/suggestion', 'MemberController@suggestion');
    //New Product
    Route::get('profile/{username}/sale/new', 'MemberController@newProduct');
    //Edit Product
    Route::get('profile/{username}/sale/edit', 'MemberController@editProduct');
    //Delete product
    Route::get('profile/{username}/sale/delete', 'MemberController@deleteProduct');
});

//Login as admin
Route::post('/login-admin', 'AdminAuth\AuthAdminController@postLogin');
Route::get('/login-as-admin', 'AdminAuth\AuthAdminController@getLogin');

//Admin
Route::group(['middleware' => ['web', 'admin']], function() {
    Route::get('/admin/member', 'AdminController@showMember');
    Route::get('/admin/member/getDownload/{username}/{file}', 'AdminController@getDownload');
    Route::get('/admin/logout', 'AdminAuth\AuthAdminController@getLogout');
    Route::get('/admin/message', 'AdminController@getMessage');
    Route::get('/admin/member/{username}', 'AdminController@showDetailMember');
    Route::get('/admin/loginAs/{username}', 'AdminController@loginAsMember');
    Route::post('/admin/member/delete', 'AdminController@deleteMember');
    Route::post('/admin/message', 'AdminController@postMessage');
    Route::get('activateMember/{username}/{statusActivation}', 'AdminController@activateMember');
    Route::get('resetQuizChance/{username}', 'AdminController@resetQuizChance');
    Route::post('/admin/reset-password', 'AdminController@resetPassword');
    Route::get('/admin/panel', 'AdminController@controlPanel');
    Route::post('/admin/panel', 'AdminController@postControlPanel');
    Route::post('/admin/quiz/quizReview', 'AdminController@reviewQuiz');
    Route::get('/admin/quiz/quizReview', 'AdminController@reviewQuiz');
    Route::post('/admin/rules', 'AdminController@postRules');
    // See the result
    Route::get('/admin/result', 'AdminController@onlineTestResult');
    // See the answer
    Route::get('/admin/result/checkAnswer/{username}', 'AdminController@checkAnswer');
    Route::get('admin/result/score/{username}', 'AdminController@score');
    Route::get('admin/ranking', 'AdminController@ranking');
    Route::get('admin/suggestion', 'AdminController@memberSuggestion');
});

Route::group(['middleware' => ['web', 'superAdmin']], function() {
    //Quiz
    Route::get('/admin/quiz', 'AdminController@quiz');
    Route::get('/admin/quiz/add', 'AdminController@addquiz');
    Route::get('/admin/quiz/edit/{{id}}', 'AdminController@editquiz');
    Route::get('/admin/quiz/delete/{{id}}', 'AdminController@deletequiz');
    Route::post('/admin/quiz/add', 'AdminController@postaddquiz');
    Route::get('/admin/quiz/edit/{id}', 'AdminController@editQuiz');
    Route::post('/admin/quiz/edit/{id}', 'AdminController@postEditQuiz');
    Route::post('/admin/quiz/delete', 'AdminController@deleteQuiz');
    Route::get('/admin/quiz/review', 'AdminController@reviewQuiz');

    // Trial
    Route::get('/admin/Trial/quiz', 'AdminController@quizTrial');
    Route::get('/admin/Trial/quiz/add', 'AdminController@addquizTrial');
    Route::get('/admin/Trial/quiz/edit/{{id}}', 'AdminController@editquizTrial');
    Route::get('/admin/Trial/quiz/delete/{{id}}', 'AdminController@deletequizTrial');
    Route::post('/admin/Trial/quiz/add', 'AdminController@postaddquizTrial');
    Route::get('/admin/Trial/quiz/edit/{id}', 'AdminController@editQuizTrial');
    Route::post('/admin/Trial/quiz/edit/{id}', 'AdminController@postEditQuizTrial');
    Route::post('/admin/Trial/quiz/delete', 'AdminController@deleteQuizTrial');
    Route::get('/admin/Trial/quiz/review', 'AdminController@reviewQuizTrial');
});

