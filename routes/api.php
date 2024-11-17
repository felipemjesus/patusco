<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', \App\Http\Controllers\Users\LoginController::class);

Route::prefix('animal-types')->group(function () {
    Route::get('', \App\Http\Controllers\AnimalTypes\IndexController::class);
});

Route::prefix('markings')->group(function () {
    Route::post('', \App\Http\Controllers\Markings\CreateController::class);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('users')->group(function () {
        Route::get('', \App\Http\Controllers\Users\IndexController::class);
    });

    Route::prefix('markings')->group(function () {
        Route::get('', \App\Http\Controllers\Markings\IndexController::class);
        Route::get('{marking}', \App\Http\Controllers\Markings\ShowController::class);
        Route::put('{marking}', \App\Http\Controllers\Markings\UpdateController::class);
        Route::delete('{marking}', \App\Http\Controllers\Markings\DestroyController::class);
    });

});
