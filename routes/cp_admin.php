<?php


Route::group(['middleware' => ['isAdmin'], 'prefix' => env('CP_PREFIX_API')], function () {
// Route::group(['middleware' => ['isAdmin'], 'prefix' => env('CP_PREFIX')], function () {

    /**************** Global *****************/

    Route::get('/models-counts', 'HomeController@modelsCounts');

    /*********************************************************************************/



    /*************************************** HR ***************************************/


    Route::group(['namespace' => 'HR'], function () {

        /**************** Users *****************/
        Route::apiResource('users', 'UserController')->parameters(['users' => 'id']);
        Route::get('users_select', 'UserController@users_select');
        Route::patch('users/restore/{id}', 'UserController@restoreUser');
        Route::post('users/delete_restore_multi', 'UserController@deleteRestoreMulti');
        /*********************************************************************************/

        /**************** departments *****************/
        Route::apiResource('departments', 'DepartmentController')->parameters(['departments' => 'id']);
        Route::get('departments_select', 'DepartmentController@departments_select');
        Route::get('departments_with_users_select', 'DepartmentController@departments_with_users_select');
        Route::post('departments/delete_restore_multi', 'DepartmentController@deleteRestoreMulti');
        /*********************************************************************************/



        /**************** attendances *****************/
        Route::apiResource('attendances', 'AttendanceController')->parameters(['attendances' => 'id']);
        /*********************************************************************************/


        /**************** requests *****************/
        Route::apiResource('requests', 'RequestController')->parameters(['requests' => 'id']);
        /*********************************************************************************/

        /**************** reports *****************/

        /*********************************************************************************/


        /**************** permissions *****************/

        // roles
        Route::apiResource('roles', 'AclController')->parameters(['roles' => 'id']);
        Route::get('/name_roles', 'AclController@getNameRoles');

        // permissions
        Route::get('/permissions', 'AclController@getListPermissions');

        // user
        Route::get('/roles_permissions_for_user/{id}', 'AclController@getRolesAndPermissionsForUser');
        Route::put('/assign_to_user/{id}', 'AclController@assignToUser');

        /*********************************************************************************/

    });
    /**************************************************************************************/




    /*************************************** CRM ***************************************/
    Route::group(['namespace' => 'CRM'], function () {

        /**************** leads *****************/
        Route::apiResource('leads', 'LeadController')->parameters(['leads' => 'id']);
        Route::get('leads_select', 'LeadController@leads_select');
        Route::get('leads_search', 'LeadController@leads_search');
        Route::put('leads/change_status/{id}', 'LeadController@change_status');
        Route::patch('leads/restore/{id}', 'LeadController@restoreLead');
        Route::post('leads/delete_restore_multi', 'LeadController@deleteRestoreMulti');
        Route::post('leads_new','LeadController@leads_new');
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
    /**************************************************************************************/


    /**************** services *****************/
    Route::apiResource('currencies', 'CurrenciesController')->parameters(['currencies' => 'id']);
    /*********************************************************************************/




    /*************************************** ProjectManagement ***************************************/
    Route::group(['namespace' => 'ProjectManagement'], function () {

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
    /**************************************************************************************/





    /*************************************** Accounting ***************************************/
    Route::group(['namespace' => 'Accounting'], function () {

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
    /**************************************************************************************/




    /*************************************** Designs ***************************************/
    Route::group(['namespace' => 'Designs'], function () {

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



    /*************************************** WebDevelopment ***************************************/
    Route::group(['namespace' => 'WebDevelopment'], function () {

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

     /**************** Calendar *****************/
      Route::get('agenda/trashed', 'CalendarController@onlyTrashed');
      Route::get('agenda/find-event', 'CalendarController@search');
      Route::apiResource('agenda', 'CalendarController');
     /*********************************************************************************/


    /*************************************** Note ***************************************/
    Route::group(['namespace' => 'Note'], function () {

        /**************** todos *****************/
        Route::get('todos', 'TodoController@index');
        Route::put('todos', 'TodoController@update');
        /*********************************************************************************/
    });
    /**************************************************************************************/




    /*************************************** Settings ***************************************/

    // Route::apiResource('settings', 'SettingController')->parameters(['settings' => 'id']);
    // Route::get('settings/get/{name}', 'SettingController@getByName');
    // Route::put('settings/save', 'SettingController@save');
    // Route::post('settings/delete_restore_multi', 'SettingController@deleteRestoreMulti');

    /*********************************************************************************/


});