<?php
 use App\Http\Controllers\User\HomeController;
 use Illuminate\Support\Facades\Route;

 // Khu vực home riêng chỉ dành cho người dùng đã đăng nhập.
 Route:: middleware(['auth', ])
 -> group(function (){
    Route:: get('/home', [HomeController::class, 'index']);
 });
