<?php

Route::group(['middleware' => 'web', 'prefix' => 'setting', 'namespace' => 'Modules\Setting\Http\Controllers'], function()
{
    Route::get('/', 'SettingController@index');
});
