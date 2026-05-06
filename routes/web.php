<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

/*
|-------------------------------------------------------------------------- 
| Web Routes 
|-------------------------------------------------------------------------- 
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Đăng nhập đăng ký phân quyền
Route::get('/dashboard', function () {
    // Nếu là admin → chuyển sang admin panel
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Dành cho user bình thường
    return view('dashboard');  // Hiển thị trang Dashboard cho user
})->middleware(['auth'])->name('dashboard');

// Route trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Các routes còn lại
Route::get('/accounts', [AccountController::class, 'index']);

require __DIR__ . '/auth.php';