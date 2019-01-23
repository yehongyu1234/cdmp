<?php



Route::group(['middleware' => 'web', 'prefix' => 'project', 'namespace' => 'Modules\Project\Http\Controllers'], function()
{
    Route::resource('', 'ProjectController');
    Route::get('projectdata', 'ProjectController@projectdata');//TODO 这里需要安全防护
    Route::get('{guid}/out','ProjectController@nice');
    Route::get('{project_id}/show','ProjectController@show');
    Route::any('{project_id}/edit','ProjectController@edit');
    Route::any('{project_id}/destroy','ProjectController@destroy');
    Route::any('{project_id}/creatask','ProjectController@creatask');
    Route::any('getlist','ProjectController@getlist');
});

Route::group(['middleware' => 'web', 'prefix' => 'building', 'namespace' => 'Modules\Project\Http\Controllers'], function()
{
    Route::resource('', 'BuildingController');
    Route::get('{guid}/building','BuildingController@outshow');
    Route::get('{building_id}/show','BuildingController@show');
    Route::get('{building_id}/model','BuildingController@model');
    Route::any('{building_id}/edit','BuildingController@edit');
    Route::any('{building_id}/destroy','BuildingController@destroy');
});
