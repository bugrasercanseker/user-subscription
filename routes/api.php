<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\SubscriptionController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::prefix('user')->group(function () {
    Route::controller(UserController::class)->group(function () {
       Route::get('/{user}', 'get');
    });

    Route::prefix('{user}/subscription')->controller(SubscriptionController::class)->group(function () {
       Route::post('/', 'store');
       Route::put('/{subscription}', 'update');
       Route::delete('/{subscription}', 'delete');
    });

    Route::prefix('{user}/transaction')->controller(TransactionController::class)->group(function () {
        Route::post('/', 'store');
    });
});
