<?php

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

Route::get('/', 'Admin\PageController@login')->name('login');

Route::post('/signin', 'Auth\UserController@signin')->name('signin');

Route::get('/logout', 'Auth\UserController@logout')->name('logout');


//=======Admin=======//
Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'before' => 'admin'], function () {

    Route::get('/dashboard', 'Admin\PageController@dashboard')->name('admindashboard');

    Route::get('/course', 'Admin\PageController@course')->name('admincourse');

    Route::post('/save-course', 'Admin\CourseController@savecourse')->name('adminsavecourse');

    Route::get('/delete-course/{id}', 'Admin\CourseController@deletecourse')->name('deletecourse');


    Route::get('/lesson', 'Admin\PageController@lesson')->name('adminlesson');

    Route::post('/save-lesson', 'Admin\LessonController@savelesson')->name('adminsavelesson');

    Route::get('/delete-lesson/{id}', 'Admin\LessonController@deletelesson')->name('deletelesson');


    Route::get('/trainees', 'Admin\PageController@trainee')->name('admintrainee');

    Route::post('/savelogin', 'Auth\UserController@savelogin')->name('savelogin');

    Route::get('/delete-user/{id}', 'Auth\UserController@deletetrainee')->name('deletetrainee');


    Route::get('/feedback', 'Admin\PageController@feedback')->name('adminfeedback');

    Route::get('/delete-feedback/{id}', 'Admin\PageController@deletefeedback')->name('deletefeedback');
});

//=======Trainee=======//
Route::group(['middleware' => 'auth', 'prefix' => 'trainee', 'before' => 'trainee'], function () {

    Route::get('/dashboard', 'Student\PageController@dashboard')->name('traineedashboard');


    Route::get('/courses', 'Student\PageController@course')->name('traineecourse');

    Route::get('/lesson', 'Student\PageController@lesson')->name('traineelesson');

    Route::get('/take-lesson/{id}', 'Student\PageController@takelesson')->name('traineetakelesson');


    Route::get('/feedback', 'Student\PageController@feedback')->name('traineefeedback');

    Route::post('/save-feedback', 'Student\PageController@savefeedback')->name('traineesavefeedback');


    Route::get('/profile', 'Student\PageController@profile')->name('traineeprofile');

    Route::get('/edit-profile/{id}', 'Student\PageController@editprofile')->name('traineeeditprofile');

    Route::post('/update-profile/{id}', 'Auth\UserController@updateprofile')->name('traineeupdateprofile');

    Route::post('/update-user/{id}', 'Auth\UserController@updateuser')->name('updateuser');
});
