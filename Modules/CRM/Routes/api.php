<?php

use Illuminate\Http\Request;

Route::group(['middleware' => ['isAdmin'], 'prefix' => '/crm'], function () {

    /**************** leads *****************/
    Route::apiResource('leads', 'LeadController')->parameters(['leads' => 'id']);
    Route::get('leads_select', 'LeadController@leads_select');
    Route::get('leads_search', 'LeadController@leads_search');
    Route::put('leads/change_status/{id}', 'LeadController@change_status');
    Route::patch('leads/restore/{id}', 'LeadController@restoreLead');
    Route::post('leads/delete_restore_multi', 'LeadController@deleteRestoreMulti');
    /*********************************************************************************/

    /**************** clients *****************/
    Route::apiResource('clients', 'LeadController')->parameters(['clients' => 'id']);
    Route::put('clients/change_status/{id}', 'LeadController@change_status');
    Route::patch('clients/restore/{id}', 'LeadController@restoreLead');
    Route::post('clients/delete_restore_multi', 'LeadController@deleteRestoreMulti');
    /*********************************************************************************/


    /**************** meetings *****************/
    Route::apiResource('meetings', 'MeetingController')->parameters(['meetings' => 'id']);
    Route::get('meetings_select', 'MeetingController@meetings_select');
    Route::put('meetings/change_status/{id}', 'MeetingController@change_status');
    Route::patch('meetings/restore/{id}', 'MeetingController@restoreMeeting');
    Route::post('meetings/delete_restore_multi', 'MeetingController@deleteRestoreMulti');
    /*********************************************************************************/


    /**************** lead_statuses *****************/
    Route::get('lead_statuses', 'LeadStatusController@index');
    Route::put('lead_statuses', 'LeadStatusController@update');
    Route::get('lead_statuses_select', 'LeadStatusController@index');
    /*********************************************************************************/


    /**************** sales_commissions *****************/
    Route::get('sales_commissions', 'SalesCommissionController@index');
    Route::put('sales_commissions', 'SalesCommissionController@update');
    /*********************************************************************************/


    /**************** services *****************/
    Route::apiResource('services', 'ServiceController')->parameters(['services' => 'id']);
    Route::get('services_select', 'ServiceController@services_select');
    Route::patch('services/restore/{id}', 'ServiceController@restoreLeadContract');
    Route::post('services/delete_restore_multi', 'ServiceController@deleteRestoreMulti');
    /*********************************************************************************/


    /**************** lead_contracts *****************/
    Route::apiResource('lead_contracts', 'LeadContractController')->parameters(['lead_contracts' => 'id']);
    Route::patch('lead_contracts/restore/{id}', 'LeadContractController@restoreLeadContract');
    Route::post('lead_contracts/delete_restore_multi', 'LeadContractController@deleteRestoreMulti');
    Route::get('lead_contracts/payments/{id}', 'LeadContractController@getPayments');
    Route::put('lead_contracts/payments/{id}', 'LeadContractController@updatePayments');
    Route::post('send/payment/{id}', 'LeadContractController@sendInvoiceToMail');
    /*********************************************************************************/


    /**************** quotations *****************/
    Route::apiResource('quotations', 'QuotationController')->parameters(['quotations' => 'id']);
    Route::post('quotations/delete_restore_multi', 'QuotationController@deleteRestoreMulti');
    Route::post('send/quotation/{id}', 'QuotationController@sendQuotationToMail');
    /*********************************************************************************/

    /**************** reports *****************/
    Route::get('/crm-total-counts', 'ReportController@totalCounts');
    /*********************************************************************************/


});