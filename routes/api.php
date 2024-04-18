<?php


use App\Http\Controllers\Api\V1\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->name('auth.')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::get('get-current-user', [AuthController::class, 'getUser'])->name('get-current-user');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('refresh-token', [AuthController::class, 'refreshAccessToken'])->name('refresh-token');
});

