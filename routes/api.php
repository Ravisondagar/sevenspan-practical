<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Login api
Route::post('/login', 'API\AuthenticationController@login');
Route::group(['namespace' => 'API', 'middleware' => 'auth:sanctum'], function () {
    // user resource route
    Route::resource('users', 'UserController')->middleware('admin');
    // user update hobby
    Route::post('/user/update-hobby', 'UserHobbyController@updateHobby');
    // filter user listing by hobby
    Route::post('/filter-user-hobby', 'UserController@filterUserHobby');
});
