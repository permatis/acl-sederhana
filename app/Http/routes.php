<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', 'TaskController', ['except' => ['create', 'show']]);

Route::group(['prefix' => 'api/v1/ajax/'], function() {
	Route::post('tasks', 'AjaxController@tasks');
});


Route::get('test', function() {
	$routeCollection = Route::getRoutes();

echo "<table style='width:100%'>";
    echo "<tr>";
        echo "<td width='10%'><h4>HTTP Method</h4></td>";
        echo "<td width='10%'><h4>Route</h4></td>";
        echo "<td width='80%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        echo "<tr>";
            echo "<td>" . $value->getMethods()[0] . "</td>";
            echo "<td>" . $value->getPath() . "</td>";
            echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
echo "</table>";
});


Route::group(['middleware' => ['web']], function () {
	//
});
