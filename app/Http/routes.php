<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', 'TaskController', ['except' => ['create', 'show']]);
Route::resource('users', 'UserController', ['except' => ['create', 'show']]);
Route::resource('roles', 'RoleController', ['except' => ['create', 'show']]);
Route::resource('permissions', 'PermissionController', ['except' => ['create', 'show']]);

Route::group(['prefix' => 'api/v1/ajax/', 'middleware' => ['cors']], function() {
	Route::post('tasks', 'AjaxController@tasks');
	Route::post('users', 'AjaxController@users');
	Route::post('roles', 'AjaxController@roles');
	Route::post('permissions', 'AjaxController@permissions');
});

Route::group(['middleware' => ['web']], function () {
	//
});
