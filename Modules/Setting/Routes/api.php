<?php

use Illuminate\Http\Request;


Route::group(['middleware' => ['isAdmin'], 'prefix' => '/setting'], function () {

    Route::apiResource('settings', 'SettingController')->parameters(['settings' => 'id']);
    Route::get('settings/get/{name}', 'SettingController@getByName');
    Route::put('settings/save', 'SettingController@save');
    Route::post('settings/delete_restore_multi', 'SettingController@deleteRestoreMulti');

});