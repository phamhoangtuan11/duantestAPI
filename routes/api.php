<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\OrderApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API công khai cung cấp danh sách tài khoản cho trang chủ.
Route::get('/accounts', [AccountController::class, 'index']);

// API mua tài khoản: yêu cầu phiên đăng nhập Sanctum.
Route::middleware('auth:sanctum')->post(
    '/buy-account/{id}',
    [OrderApiController::class, 'buy']
);
