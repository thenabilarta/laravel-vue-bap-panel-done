<?php

Route::group(['middleware' => 'web', 'prefix' => 'display', 'namespace' => 'Modules\Display\Http\Controllers'], function()
{
    Route::get('/', 'DisplayController@index');
    Route::get('/data', 'DisplayController@data');
});
