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

Route::post('auth/resetPassword', 'UserController@resetPassword');
Route::post('auth/forgotPassword', 'UserController@forgotPassword');
Route::post('clubs/join', 'ClubController@join');

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('users', 'UserController');
    Route::apiResource('departments', 'DepartmentController');
    Route::apiResource('positions', 'PositionController');
    Route::apiResource('employees', 'EmployeeController');
    Route::put('employees/{employee}/responseEvent', 'EmployeeController@updateEmployeeEventResponse');
    Route::post('employees/issueJoinClubTickets', 'EmployeeController@issueJoinClubTickets');
    Route::apiResource('clubs', 'ClubController');
    Route::post('clubs/{club}/addMember', 'ClubController@addMember');
    Route::apiResource('budgets', 'BudgetController');
    Route::apiResource('events', 'EventController');
    Route::apiResource('announcements', 'AnnouncementController');
    Route::post('announcements/imageUpload', 'AnnouncementController@storeTransientImage');
    Route::apiResource('liquidations', 'LiquidationController');
    Route::delete('auth/token', 'Auth\TokenController@destroy');
    Route::get('me', 'UserController@me');
});
