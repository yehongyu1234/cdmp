<?php

Route::group(['middleware' => 'web', 'prefix' => 'company', 'namespace' => 'Modules\Setting\Http\Controllers'], function()
{
    Route::resource('', 'CompanyController');
    Route::get('{id}/show','CompanyController@show');
    Route::any('{id}/edit','CompanyController@edit');
    Route::any('{id}/destroy','CompanyController@destroy');
    Route::any('getlist','CompanyController@getlist');
});
