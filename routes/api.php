<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EventPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// authentication 
Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

// protected route 
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});


//get all the users
Route::get('allUsers', [AuthController::class, 'index']);

//post user role as admin
Route::put('manageAdmin/{uid}', [AuthController::class, 'update']);





//get all the events
Route::get('allEvents', [EventPostController::class, 'index']);

//post events to db
Route::post('createEvent', [EventPostController::class, 'store']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
