<?php

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

Route::post('users/resetPassword', 'UserController@resetPassword');
Route::post('users/forgotPassword', 'UserController@forgotPassword');

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('users', 'UserController');
    Route::apiResource('departments', 'DepartmentController');
    Route::apiResource('positions', 'PositionController');
    Route::apiResource('employees', 'EmployeeController');
});
