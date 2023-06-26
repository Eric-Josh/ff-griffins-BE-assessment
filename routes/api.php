<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

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

Route::middleware(['auth:sanctum','verified'])->group(function() {
    // Route::get('user', function (Request $request) {
    //     return $request->user();
    // });

    Route::group(['middleware' => ['role:admin']], function() {
        Route::get('users', [UserController::class, 'index']);
        Route::group(['prefix' => 'user'], function () {
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::delete('/{id}', [UserController::class, 'delete']);
        });
    });

    Route::post('logout', [LogoutController::class, 'logout']);
});

Route::post('login', [LoginController::class, 'login']);