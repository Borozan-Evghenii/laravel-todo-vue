<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::prefix('/tasks')->group(function () {
        Route::get('/', [TaskController::class, 'all']);
        Route::get('/{id}', [TaskController::class, 'getById']);
        Route::post('/', [TaskController::class, 'create']);
        Route::put('/{id}', [TaskController::class, 'update']);
        Route::delete('/{id}', [TaskController::class, 'delete']);
    });
    Route::prefix('/category')->group(function () {
        Route::get('/', [CategoryController::class, 'all']);
        Route::get('/{id}', [CategoryController::class, 'getById']);
        Route::post('/', [CategoryController::class, 'create']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'delete']);
    });
});
