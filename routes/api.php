<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/loginuser',[\App\Http\Controllers\Api\AuthUserController::class,'loginuser']);
Route::get('/dashboard/{id}',[\App\Http\Controllers\Api\DashboardController::class,'dashboard']);
Route::get('/getlicences/{id}/user',[\App\Http\Controllers\Api\FeeAndLicenceController::class,'getlicences']);
Route::get('/getlicences/{id}',[\App\Http\Controllers\Api\FeeAndLicenceController::class,'licencedetail']);
Route::get('/getpayments/{id}',[\App\Http\Controllers\Api\PaymentsController::class,'getpayments']);
Route::get('/getpayment/{id}',[\App\Http\Controllers\Api\PaymentsController::class,'paymentdetail']);
Route::post('/createpayment',[\App\Http\Controllers\Api\PaymentsController::class,'createpayment']);

Route::get('/get-status/{id}',[\App\Http\Controllers\Api\PaymentsController::class,'getstatus']);
Route::get('/verify/{id}',[\App\Http\Controllers\Api\PaymentsController::class,'verify']);





Route::get('/hello',[\App\Http\Controllers\Api\DashboardController::class,'index']);





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
