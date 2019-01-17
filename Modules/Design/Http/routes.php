<?php

Route::group(['middleware' => 'web', 'prefix' => 'task', 'namespace' => 'Modules\Design\Http\Controllers'], function()
{
    Route::resource('', 'TaskController');
    Route::get('{task_id}/show','TaskController@show');
    Route::any('{task_id}/edit','TaskController@edit');
    Route::any('{task_id}/destroy','TaskController@destroy');
    Route::any('getlist','TaskController@getlist');
    Route::any('status','TaskController@status');
    Route::any('personget','TaskController@personget');
});
Route::group(['middleware' => 'web', 'prefix' => 'tcheck', 'namespace' => 'Modules\Design\Http\Controllers'], function()
{
    Route::resource('', 'TcheckController');
    Route::get('{task_id}/show','TcheckController@show');
    Route::any('{task_id}/edit','TcheckController@edit');
    Route::any('{task_id}/destroy','TcheckController@destroy');
    Route::any('getlist','TcheckController@getlist');
    Route::any('status','TcheckController@status');
    Route::any('personget','TcheckController@personget');
});

