<?php
#Route::get('users', 'UserController@index');
Route::get('/users',                    ['as' => 'user.index'               ,'uses' => 'UserController@index']);


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
Route::delete('user/{userid}',          [
                                        'as' => 'user.destroy',
                                        'uses' => 'UserController@destroy',
                                        //'middleware' => ['roles'],
                                        //'roles' => ['root']                   // Only an root can delete from database
]);