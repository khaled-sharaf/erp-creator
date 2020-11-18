<?php

use Illuminate\Http\Request;


Route::group(['middleware' => ['isAdmin'], 'prefix' => '/hr'], function () {
// Route::group(['prefix' => '/hr'], function () {

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