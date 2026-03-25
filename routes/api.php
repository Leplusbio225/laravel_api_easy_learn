<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MotifController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\VisitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/registration', [AuthController::class, 'registration']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::get('/home', HomeController::class)->middleware('auth:sanctum');

    Route::apiResource('clients', ClientController::class)->middleware('auth:sanctum');
    Route::apiResource('roles', RoleController::class)->middleware('auth:sanctum');
    Route::apiResource('motifs', MotifController::class)->middleware('auth:sanctum');

    Route::apiResource('visits', VisitController::class)->middleware('auth:sanctum');
});
