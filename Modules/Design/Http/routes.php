<?php

Route::group(['middleware' => 'web', 'prefix' => 'design', 'namespace' => 'Modules\Design\Http\Controllers'], function()
{
    Route::get('/', 'DesignController@index');
});
