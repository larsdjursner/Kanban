<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\BoardController;

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

Route::get('/', function () {
    return "yoooo";
});


Route::get('/boards',[BoardController::class, 'index']);
Route::get('/boards/{id}',[BoardController::class, 'show']);
Route::post('/boards',[BoardController::class, 'store']);
Route::put('/boards/{id}',[BoardController::class, 'update']);
Route::delete('/boards/{id}',[BoardController::class, 'destroy']);