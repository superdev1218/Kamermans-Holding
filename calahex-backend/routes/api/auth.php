<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('send', [AuthController::class, 'send']);
Route::post('change', [AuthController::class, 'change']);
Route::post('signup', [AuthController::class, 'signup']);
Route::post('confirm', [AuthController::class, 'confirm']);
Route::post('profile', [AuthController::class, 'profile']);
Route::post('profilechange', [AuthController::class, 'profilechange']);
Route::post('phone', [AuthController::class, 'phone']);
Route::post('two', [AuthController::class, 'two']);
Route::post('reconfirm', [AuthController::class, 'reconfirm']);
Route::post('check2faenable', [AuthController::class, 'check2faenable']);
Route::post('check2faenables', [AuthController::class, 'check2faenables']);
Route::get('disable2fa/{id}', [AuthController::class, 'disable2fa']);
Route::get('profile/{id}', [AuthController::class , 'getprofile']);

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('logout', [AuthController::class, 'logout']);
});
