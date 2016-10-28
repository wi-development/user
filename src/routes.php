<?php
#Route::get('users', 'UserController@index');
Route::get('/usersORG',                    ['as' => 'user.index'               ,'uses' => 'UserController@index']);

Route::get('/users',                                   ['as' => 'user.all.index',          'uses' => 'UserController@getAllIndex']);
Route::get('/user/all/data',                           ['as' => 'user.all.data',           'uses' => 'UserController@allIndexData']);




//users edit & upate ONLY ADMINISTRATORS AND AUTH USER
Route::get('user/{userid}/edit',        ['as' => 'user.edit',               'uses' => 'UserController@edit']);  //checked by UserPolicy
Route::patch('user/update/{userid}',    ['as' => 'user.update',             'uses' => 'UserController@update']);  //checked by UserPolicy


//users create & store ONLY ADMINISTRATORS
Route::get('user/create',               [
                                        'as' => 'user.create',
                                        'uses' => 'UserController@create',
                                        //'middleware' => ['roles'],			// A 'roles' middleware must be specified
                                        //'roles' => ['administrator'] 		    // Only an administrator can access this route
]);

Route::post('user/store',               ['as' => 'user.store',
                                        'uses' => 'UserController@store',
                                        //'middleware' => ['roles'],
                                        //'roles' => ['administrator'] 		    // Only an administrator can store in database
]);

//user delete ONLY ROOT
Route::delete('user/{userid?}',          [
                                        'as' => 'user.destroy',
                                        'uses' => 'UserController@destroy',
                                        //'middleware' => ['roles'],
                                        //'roles' => ['root']                   // Only an root can delete from database
]);

/*
 * ROLES
 * */

Route::get('/roles',                        ['as' => 'role.all.index',          'uses' => 'RoleController@getAllIndex']);
Route::get('/role/all/data',                ['as' => 'role.all.data',           'uses' => 'RoleController@allIndexData']);

Route::get('/role/{id}/edit',                ['as' => 'role.edit',               'uses' => 'RoleController@edit']);
Route::patch('/role/update/{id}',            ['as' => 'role.update',             'uses' => 'RoleController@update']);

Route::get('/role/create',                   ['as' => 'role.create',             'uses' => 'RoleController@create',
	//'middleware' => ['roles'],			// A 'roles' middleware must be specified
	//'roles' => ['administrator'] 		    // Only an administrator can access this route
]);


Route::post('/role/store',                   ['as' => 'role.store',              'uses' => 'RoleController@store',
	//'middleware' => ['roles'],
	//'roles' => ['administrator'] 		    // Only an administrator can store in database
]);


//user delete ONLY ROOT
Route::delete('role/{id?}',          [
	'as' => 'role.destroy',
	'uses' => 'RoleController@destroy',
	//'middleware' => ['roles'],
	//'roles' => ['root']                   // Only an root can delete from database
]);


/*
 * PERMISSIONS
 * */

Route::get('/permissions',                      ['as' => 'permission.all.index',            'uses' => 'PermissionController@getAllIndex']);
Route::get('/permission/all/data',              ['as' => 'permission.all.data',             'uses' => 'PermissionController@allIndexData']);


Route::get('/permission/{id}/edit',                ['as' => 'permission.edit',               'uses' => 'PermissionController@edit']);
Route::patch('/permission/update/{id}',            ['as' => 'permission.update',             'uses' => 'PermissionController@update']);


Route::get('/permission/create',                   ['as' => 'permission.create',             'uses' => 'PermissionController@create',
	//'middleware' => ['roles'],			// A 'roles' middleware must be specified
	//'roles' => ['administrator'] 		    // Only an administrator can access this route
]);


Route::post('/permission/store',                   ['as' => 'permission.store',              'uses' => 'PermissionController@store',
	//'middleware' => ['roles'],
	//'roles' => ['administrator'] 		    // Only an administrator can store in database
]);


//user delete ONLY ROOT
Route::delete('permission/{id?}',          [
	'as' => 'permission.destroy',
	'uses' => 'PermissionController@destroy',
	//'middleware' => ['roles'],
	//'roles' => ['root']                   // Only an root can delete from database
]);