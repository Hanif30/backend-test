<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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
    return response()->json('Welcome to backend-test api.');
});

Route::prefix('post')->group(function () {
    Route::get('/all', [PostController::class, 'index']);
    Route::get('/{post}', [PostController::class, 'show'])->where('post', '[0-9]+');
    Route::get('/top', [PostController::class, 'top']);
});

Route::prefix('comment')->group(function () {
    Route::get('/all', [CommentController::class, 'index']);
    Route::post('/filter', [CommentController::class, 'filter']);
});