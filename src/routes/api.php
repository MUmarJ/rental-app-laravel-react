<?php

use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection as PostCollection;
use App\Post;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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

Route::get('/post/{post}', function ($postId) {
    return new PostResource(Post::find($postId));
});

Route::get('/posts', function () {
    return new PostCollection((Post::all()));
});
