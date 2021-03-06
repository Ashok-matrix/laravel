<?php

Route::get('/', [
	'as' => 'home',
	'uses' => 'PagesController@home'
]);

/**
 * Registration!
 */
Route::get('register', [
	'as' => 'register_path',
	'uses' => 'RegistrationController@create'
]);

Route::post('register', [
	'as' => 'register_path',
	'uses' => 'RegistrationController@store'
]);

/**
 * Sessions!
 */
Route::get('login', [
	'as' => 'login_path',
	'uses' => 'SessionsController@create'
]);

Route::post('login', [
	'as' => 'login_path',
	'uses' => 'SessionsController@store'
]);

Route::get('logout', [
	'as' => 'logout_path',
	'uses' => 'SessionsController@destroy'
]);

/**
 * Projects!
 */

Route::get('projects/new', [
	'as' => 'new_project_path',
	'uses' => 'ProjectController@create'
]);

Route::post('projects/new', [
	'as' => 'new_project_path',
	'uses' => 'ProjectController@store'
]);

/**
 * Profile!
 */
Route::get('profile', [
	'as' => 'edit_profile',
	'uses' => 'ProfileController@edit'
]);
 /**
* Reset password
*/

Route::get('reset_password', [
	'as' => 'reset_password',
	'uses' => 'ProfileController@resetPasswordForm'
]);


Route::post('reset_password', [
	'as' => 'reset_password',
	'uses' => 'ProfileController@resetPassword'
]);