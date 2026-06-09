<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\ServiceRequestController;

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
// 
Route::get('/checkout/{id}', [OrderController::class, 'checkout']);
//  
Route::get('/my-orders', [OrderController::class, 'myOrders']);
// thanh toán nạp tiền
Route::get('/deposit', [DepositController::class, 'index']);
Route::post('/deposit', [DepositController::class, 'store']); 

// chính sách dịch vụ
Route::get('/chinh-sach-dich-vu', function () {
    return view('policy.service');
});
// chính sách hệ thống
Route::get('/chinh-sach-he-thong', function(){
    return view('policy.system');
});
Route::get('/gioi-thieu-he-thong', function(){
    return view('introduce.system');
});
// dịch vụ checkpoint fb
Route::get('/service/{platform}/{slug}', function ($platform, $slug) {

   return view('services.detail', compact('platform', 'slug'));

});
//  dịch vụ yêu cầu hỗ trợ
Route::post('/service-request', [ServiceRequestController::class, 'store']);
require __DIR__ . '/auth.php';