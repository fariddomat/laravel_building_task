<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthControllerJWT;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'middleware' => 'api',
    'namespace' => '\App\Http\Controllers',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthControllerJWT@login');
    Route::post('register', 'AuthControllerJWT@register');
    Route::post('logout', 'AuthControllerJWT@logout');
    Route::post('refresh', 'AuthControllerJWT@refresh');
    Route::post('me', 'AuthControllerJWT@me');
});

 
Route::get('index', 'HomeController@index');
Route::post('search', 'HomeController@search');


Route::group([
    'middleware' => ['role:owner|admin'],
    'prefix' => 'owner/buildings'
], function ($router) {
    Route::post('index', 'BuildingsController@index');
    Route::post('show/{id}', 'BuildingsController@show');
    Route::post('store', 'BuildingsController@store');
    Route::post('update/{id}', 'BuildingsController@update');
    Route::post('destroy/{id}', 'BuildingsController@destroy');
});

Route::group([
    'middleware' => ['role:admin'],
    'prefix' => 'admin'
], function ($router) {
    Route::post('index', 'AdminController@index');
    Route::post('approve/{id}', 'AdminController@approve');
    Route::post('un_approve/{id}', 'AdminController@un_approve');
    Route::post('makeOwner/{id}', 'AdminController@makeOwner');
    Route::post('unMakeOwner/{id}', 'AdminController@unMakeOwner');
});
