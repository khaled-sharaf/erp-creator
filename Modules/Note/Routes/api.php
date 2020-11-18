<?php

use Illuminate\Http\Request;

Route::group(['middleware' => ['isAdmin'], 'prefix' => '/note'], function () {

    /**************** todos *****************/
    Route::get('todos', 'TodoController@index');
    Route::put('todos', 'TodoController@update');
    /*********************************************************************************/

});