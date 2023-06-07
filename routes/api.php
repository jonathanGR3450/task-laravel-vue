<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    
    Route::middleware('auth:api')->group(function () {
        Route::resource('/tasks', TaskController::class);
        Route::post('/tasks/{task}/toggled', [TaskController::class, 'toggled']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
