<?php



Route::group(['middleware' => 'web', 'prefix' => 'project', 'namespace' => 'Modules\Project\Http\Controllers'], function()
{
    Route::resource('', 'ProjectController');
    Route::get('projectdata', 'ProjectController@projectdata');//TODO 这里需要安全防护
    Route::get('{project_id}/nice','ProjectController@nice');
    Route::get('{project_id}/show','ProjectController@show');
    Route::any('{project_id}/edit','ProjectController@edit');
    Route::any('{project_id}/destroy','ProjectController@destroy');
    Route::any('{project_id}/creatask','ProjectController@creatask');
    Route::any('getlist','ProjectController@getlist');
});
