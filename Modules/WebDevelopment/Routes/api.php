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

// Route::middleware('auth:api')->get('/webdevelopment', function () {
  Route::group(['middleware' => ['isAdmin'], 'prefix' => '/webdevelopment'], function () {

    /*************************************** WebDevelopment ***************************************/

      /**************** hostings *****************/
      Route::apiResource('hostings', 'HostingController')->parameters(['hostings' => 'id']);
      Route::get('hostings_select', 'HostingController@hostings_select');
      Route::patch('hostings/restore/{id}', 'HostingController@restoreHostings');
      Route::post('hostings/delete_restore_multi', 'HostingController@deleteRestoreMulti');
      /*********************************************************************************/

      /**************** domains *****************/
      Route::apiResource('domains', 'DomainController')->parameters(['domains' => 'id']);
      Route::get('domains_select', 'DomainController@domains_select');
      Route::patch('domains/restore/{id}', 'DomainController@restoreDomains');
      Route::post('domains/delete_restore_multi', 'DomainController@deleteRestoreMulti');
      /*********************************************************************************/


      /**************** Websites *****************/
      Route::apiResource('websites', 'WebsiteController')->parameters(['websites' => 'id']);
      Route::post('websites/delete-selected-websites', 'WebsiteController@multiDelete');
      // Route::get('websites/findweb', 'WebsiteController@search');
      Route::get('websites/{search}', 'WebsiteController@search');
      /*********************************************************************************/


      /**************** reports *****************/
      Route::get('/web-total-counts', 'ReportController@totalCounts');
      /*********************************************************************************/

});

