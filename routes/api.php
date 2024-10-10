<?php

use App\Http\Controllers\API\Admin\CompanyController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::namespace('API')->group(function () {
    // Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function() {
        // Route::post('/logout', [AuthController::class, 'logout']);

        Route::prefix('company')->group(function() {
            Route::get('/', [CompanyController::class, 'index']);
            Route::post('/store', [CompanyController::class, 'store']);
            Route::post('/{id}', [CompanyController::class, 'show']);
            Route::post('/{id}/update', [CompanyController::class, 'update']);
            Route::post('/{id}/delete', [CompanyController::class, 'destroy']);
        });
    });
});
