<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});
Route::get('/v1/cars', function (Request $request) {
    echo $request;
    return response()->json(['cars' => [
        'registration' => 'ABC001',
        "dateRegistered" => '2019-01-01',
        'color' => 'black', 'make' => 'tesla',
        'model' => 's'
    ]], 200);
});
