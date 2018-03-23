<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => '/admin', 'middleware' => 'auth', 'namespace' => 'admin'], function () {
    Route::get('/course', 'CourseController@index')->name('course')->middleware('auth');
    Route::get('/campus', 'CampusController@index')->name('campus')->middleware('auth');
    Route::get('/position', 'PositionController@index')->name('position')->middleware('auth');
    Route::get('/student', 'StudentController@index')->name('student')->middleware('auth');

    Route::resource('/user', 'UserController', ['as' => 'user']);
    Route::resource('/situation', 'SituationController', ['as' => 'situation']);
});

Route::group(['prefix' => '/admin/institution', 'middleware' => 'institution', 'namespace' => 'admin'], function () {
    Route::get('/', 'InstitutionController@index')->name('institution');
    Route::get('/course', 'InstitutionController@index')->name('course');
    Route::get('/campus', 'InstitutionController@index')->name('campus');
});

Route::group(['prefix' => '/development', 'middleware' => 'developer', 'namespace' => 'development'], function () {
    Route::get('/upload', 'UploadController@index')->name('upload')->middleware('auth');
    Route::post('/upload/upload', 'UploadController@upload')->middleware('auth');

    Route::get('/classifier', 'ClassifierController@index')->name('classifier')->middleware('auth');
    Route::post('/classifier/{state}/{id}', 'ClassifierController@alterState')->middleware('auth');

    Route::get('/classify', 'ClassifyController@index')->name('classify')->middleware('auth');
    Route::get('/classify/campus', 'ClassifyController@campus')->name('classify-campus')->middleware('auth');
    Route::get('/classify/course', 'ClassifyController@course')->name('classify-course')->middleware('auth');

    Route::post('/classify/new', 'ClassifyController@new')->name('classify_new')->middleware('auth');
    Route::get('/classify/period', 'ClassifyController@period')->name('classify-period')->middleware('auth');
    Route::get('/classify/test', 'ClassifyController@test')->name('classify-test')->middleware('auth');

    Route::get('/variable', 'VariableController@index')->name('variable')->middleware('auth');
    Route::post('/variable/{state}/{id}', 'VariableController@alterState')->middleware('auth');
});
