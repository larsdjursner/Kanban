<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\BoardController;
use \App\Http\Controllers\StoryController;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\TaskController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware(['cors'])->group(function () {
//     Route::post('/hogehoge', 'Controller@hogehoge');
// });
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/signin', [AuthController::class, 'signin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/getuser', [AuthController::class, 'getUser']);

    Route::get('/boards',[BoardController::class, 'index']);
    Route::get('/boards/{id}',[BoardController::class, 'show']);
    Route::post('/boards',[BoardController::class, 'store']);
    Route::put('/boards/{id}',[BoardController::class, 'update']);
    Route::delete('/boards/{id}',[BoardController::class, 'destroy']);

    Route::get('/stories',[StoryController::class, 'index']);
    Route::get('/stories/{id}',[StoryController::class, 'show']);
    Route::post('/stories',[StoryController::class, 'store']);
    Route::put('/stories/{id}',[StoryController::class, 'update']);
    Route::delete('/stories/{id}',[StoryController::class, 'destroy']);

    Route::get('/tasks',[TaskController::class, 'index']);
    Route::get('/tasks/{id}',[TaskController::class, 'show']);
    Route::post('/tasks',[TaskController::class, 'store']);
    Route::put('/tasks/{id}',[TaskController::class, 'update']);
    Route::delete('/tasks/{id}',[TaskController::class, 'destroy']);
});

