<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\OrderApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API accounts
Route::get('/accounts', [AccountController::class, 'index']);

// BUY ACCOUNT
Route::middleware('auth:sanctum')->post(
    '/buy-account/{id}',
    [OrderApiController::class, 'buy']
);