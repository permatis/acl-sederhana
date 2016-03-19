<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', 'TaskController', ['except' => ['create', 'show']]);

Route::group(['prefix' => 'api/v1/ajax/', 'middleware' => ['cors']], function() {
	Route::post('tasks', 'AjaxController@tasks');
});


Route::group(['middleware' => ['web']], function () {
	//
});
