<?php

Route::group(['middleware' => 'web', 'prefix' => 'factory', 'namespace' => 'Modules\Factory\Http\Controllers'], function()
{
    Route::resource('', 'FactoryController@index');
    Route::any('getlist', 'FactoryController@getlist');
});
