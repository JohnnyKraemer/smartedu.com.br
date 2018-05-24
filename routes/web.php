<?php
Auth::routes();
Route::get('/', 'Admin\InstitutionController@index')->middleware('institution');
Route::get('/teste', 'HomeController@index');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => '/admin', 'middleware' => 'auth', 'namespace' => 'admin'], function () {
    Route::get('/course', function () {
        return redirect('/admin/course/1');
    });
    Route::get('/student', function () {
        return redirect('/admin/student/1');
    });
    Route::get('/course/{id}', 'CourseController@index');
    Route::get('/student/{id}', 'StudentController@index')->name('student');
});

Route::group(['prefix' => '/admin', 'middleware' => 'admin', 'namespace' => 'admin'], function () {
    Route::get('/position', 'PositionController@index');
    Route::resource('/user', 'UserController');
    Route::post('/user/delete', 'UserController@destroy');
    Route::resource('/situation', 'SituationController');
});


Route::group(['prefix' => '/admin/institution', 'middleware' => 'institution', 'namespace' => 'admin'], function () {
    Route::get('/', 'InstitutionController@index');
});

Route::group(['prefix' => '/admin/campus', 'middleware' => 'campus', 'namespace' => 'admin'], function () {
    Route::get('/', function () {
        return redirect('/admin/campus/1');
    });
    Route::get('/{id}', 'CampusController@index');
});

Route::group(['prefix' => '/development', 'middleware' => 'developer', 'namespace' => 'development'], function () {
    Route::get('/upload', 'UploadController@index');
    Route::post('/upload/upload', 'UploadController@upload');
    Route::get('/classifier', 'ClassifierController@index');
    Route::post('/classifier/{state}/{id}', 'ClassifierController@alterState');
    Route::get('/classify', 'ClassifyController@index');
    Route::get('/variable', 'VariableController@index');
    Route::post('/variable/{state}/{id}', 'VariableController@alterState');
    Route::get('/course', 'CourseController@index');
    Route::post('/course/{state}/{id}', 'CourseController@alterState');
    Route::get('/campus', 'CampusController@index');
});
