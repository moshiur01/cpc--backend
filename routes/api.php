<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CertificateController;
use App\Http\Controllers\API\EventPostController;
use App\Http\Controllers\API\FlagController;
use App\Http\Controllers\API\UserController;
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

//update user role as admin
Route::put('manageAdmin/{uid}', [AuthController::class, 'update']);


//---------users--------//

//update user img
Route::put('updateUserImg/{uid}', [UserController::class, 'update']);

//update user cover img
Route::put('updateUserCoverImg/{uid}', [UserController::class, 'update']);

//update user display name
Route::put('updateUserDisplayName/{uid}', [UserController::class, 'update']);


//---------events--------//

//get all the events
Route::get('allEvents', [EventPostController::class, 'index']);

//post events to db
Route::post('createEvent', [EventPostController::class, 'store']);

//delete an event
Route::delete('deleteEvent/{event_id}', [EventPostController::class, 'destroy']);


//---------certificate--------//
//post a certificate
Route::post('createCertificate', [CertificateController::class, 'store']);

// get all the certificate
Route::get('certificates', [CertificateController::class, 'index']);

//delete an event
Route::delete('deleteCertificate/{certificate_id}', [CertificateController::class, 'destroy']);

//--------Flags--------//

// get all the flags
Route::get('flags', [FlagController::class, 'index']);

//initial state of a flag
Route::post('initialFlag', [FlagController::class, 'store']);

//update admin notification status
Route::put('newAdminChange/{uid}', [FlagController::class, 'update']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
