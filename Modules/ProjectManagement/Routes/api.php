<?php

use Illuminate\Http\Request;

Route::group(['middleware' => ['isAdmin'], 'prefix' => '/projectmanagement'], function () {

    /**************** platforms *****************/
    Route::get('platforms', 'PlatformController@index');
    Route::put('platforms', 'PlatformController@update');
    /*********************************************************************************/



    /**************** projects *****************/
    Route::apiResource('projects', 'ProjectController')->parameters(['projects' => 'id']);
    Route::patch('projects/restore/{id}', 'ProjectController@restoreProject');
    Route::post('projects/delete_restore_multi', 'ProjectController@deleteRestoreMulti');
    Route::post('projects/activate/{id}', 'ProjectController@activate');
    /*********************************************************************************/

});
