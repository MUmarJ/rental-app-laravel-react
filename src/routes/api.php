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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/v1/cars', function (Request $request) {
    echo $request;
    return response()->json(['cars' => [
        'registration' => 'ABC001',
        'dateRegistered' => '2019-01-01',
        'color' => 'black', 'make' => 'tesla',
        'model' => 's',
    ]], 200);
});

//Auth routes
Route::get('unauthorized', 'UserController@unauthorized');
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::group(['middleware' => ['CheckClientCredentials', 'auth:api']]
    , function () {
        Route::post('logout', 'UserController@logout');
        Route::post('user', 'UserController@user');
    });

//Post routes
Route::group(['middleware' => ['CheckClientCredentials', 'auth:api']]
    , function () {
        Route::get('posts', 'PostController@index');
        Route::post('posts', 'PostController@create');
        Route::get('posts/{photo}', 'PostController@show');
        Route::put('posts/{id}', 'PostController@edit');
        Route::get('posts/{id}/category', 'PostController@category');
        Route::get('posts/{id}/poster', 'PostController@poster');
        Route::put('posts/{id}/deactivate', 'PostController@deactivate');
    });
