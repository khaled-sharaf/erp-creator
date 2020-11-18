<?php

use Illuminate\Http\Request;

Route::group(['middleware' => ['isAdmin'], 'prefix' => '/accounting'], function () {

    /**************** accounts *****************/
    Route::apiResource('accounts', 'AccountController')->parameters(['accounts' => 'id']);
    Route::get('accounts_select', 'AccountController@accounts_select');
    Route::patch('accounts/restore/{id}', 'AccountController@restoreAccount');
    Route::post('accounts/delete_restore_multi', 'AccountController@deleteRestoreMulti');
    /*********************************************************************************/


    /**************** suppliers *****************/
    Route::apiResource('suppliers', 'SupplierController')->parameters(['suppliers' => 'id']);
    Route::get('suppliers_select', 'SupplierController@suppliers_select');
    Route::patch('suppliers/restore/{id}', 'SupplierController@restoreSupplier');
    Route::post('suppliers/delete_restore_multi', 'SupplierController@deleteRestoreMulti');
    /*********************************************************************************/


    /**************** payments *****************/
    Route::apiResource('payments', 'PaymentController')->parameters(['payments' => 'id']);
    Route::patch('payments/restore/{id}', 'PaymentController@restorePayment');
    Route::post('payments/delete_restore_multi', 'PaymentController@deleteRestoreMulti');
    /*********************************************************************************/


    /**************** expenses *****************/
    Route::apiResource('expenses', 'ExpenseController')->parameters(['expenses' => 'id']);
    Route::get('expenses_select', 'ExpenseController@expenses_select');
    Route::post('expenses/delete_restore_multi', 'ExpenseController@deleteRestoreMulti');
    /*********************************************************************************/


    /**************** purchase_orders *****************/
    Route::apiResource('purchase_orders', 'PurchaseOrderController')->parameters(['purchase_orders' => 'id']);
    Route::post('purchase_orders/delete_restore_multi', 'PurchaseOrderController@deleteRestoreMulti');
    /*********************************************************************************/

});