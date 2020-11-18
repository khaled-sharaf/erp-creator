<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['isAdmin'], 'prefix' => '/design'], function () {

    /*************************************** Designs ***************************************/

      /**************** logos *****************/
      Route::apiResource('logos', 'LogoController')->parameters(['logos' => 'id']);
      Route::post('logos/delete-selected-logos', 'LogoController@multiDelete');
      Route::get('logos/findweb', 'LogoController@search');
      /*********************************************************************************/


      /**************** social media *****************/
      Route::apiResource('social-media', 'SocialMediaController')->parameters(['social-media' => 'id']);
      Route::post('social-media/delete-selected-media', 'SocialMediaController@multiDelete');
      Route::get('social-media/findweb', 'SocialMediaController@search');

      /**************** Printing *****************/
      Route::apiResource('printing', 'PrintingController')->parameters(['printing' => 'id']);
      Route::post('printing/delete-selected-print', 'PrintingController@multiDelete');
      Route::get('printing/findweb', 'PrintingController@search');

});
