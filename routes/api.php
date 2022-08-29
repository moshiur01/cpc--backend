<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EventPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

// protected route 
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::post('createEvent', [EventPostController::class, 'store']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
