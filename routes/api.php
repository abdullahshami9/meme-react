<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('user/profile/data', [ProfileController::class, 'get_user_profile']);
Route::post('user/login', [AuthenticatedSessionController::class, 'store']);
Route::post('user/register', [RegisteredUserController::class, 'store']);
Route::post('user/logout', [ProfileController::class, 'destroy']);
Route::post('user/gender', [GenderController::class,'get_gender']);