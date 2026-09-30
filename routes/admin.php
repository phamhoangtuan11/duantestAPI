<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceRequestController;


// TOÀN BỘ ROUTE TRONG NHÓM NÀY CHỈ DÀNH CHO ADMIN.
Route::middleware(['auth', 'checkrole:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // ACCOUNTS
        Route::get('/accounts', [AccountController::class, 'index'])->name('accounts');
        Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
        Route::put('/accounts/{id}', [AccountController::class, 'update'])->name('accounts.update');
        Route::delete('/accounts/{id}', [AccountController::class, 'destroy'])->name('accounts.destroy');

        // CATEGORIES
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // USERS
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])
            ->name('users.index');

        Route::post('/users/{id}/add-money', [\App\Http\Controllers\Admin\UserController::class, 'addMoney'])
            ->name('users.addMoney');

        Route::post('/users/{id}/minus-money', [\App\Http\Controllers\Admin\UserController::class, 'minusMoney'])
            ->name('users.minusMoney');

        // SERVICE REQUESTS
        Route::get('/services', [ServiceRequestController::class, 'adminIndex'])
            ->name('services.index');

        Route::post('/services/{id}/done', [ServiceRequestController::class, 'markDone'])
            ->name('services.done');

        Route::delete('/services/{id}', [ServiceRequestController::class, 'destroy'])
            ->name('services.destroy');

        // 
        Route::get('/services/{id}', [ServiceRequestController::class, 'show'])
            ->name('services.show');

        Route::post('/services/{id}/reply', [ServiceRequestController::class, 'reply'])
            ->name('services.reply');
        // admin tl ticket
        Route::get('/service-chat/{id}/messages', function ($id) {

            return \App\Models\ServiceMessage::where(
                'service_request_id',
                $id
            )->latest()->take(50)->get()->reverse()->values();
        });
    });
// CẢNH BÁO: hai route ticket phía dưới hiện nằm ngoài nhóm auth/admin.
// Cần kiểm tra quyền sở hữu ticket trước khi triển khai production.
Route::get('/service-ticket/{id}/messages', function (\Illuminate\Http\Request $request, $id) {

    $ticket = \App\Models\ServiceRequest::findOrFail($id);
    $afterId = max(0, (int) $request->query('after_id', 0));
    $messages = $ticket->messages()
        ->when($afterId > 0, fn ($query) => $query->where('id', '>', $afterId))
        ->orderBy('id')
        ->get();

    return response()->json([
        'status' => true,
        'ticket' => $ticket,
        'messages' => $messages,
        'latest_message_id' => $messages->last()?->id ?? $afterId,
    ]);
});
// lưu tin nhắn user gửi trong ticket
Route::post('/service-ticket/{id}/message', function (\Illuminate\Http\Request $request, $id) {

    $request->validate([
        'message' => 'required|string',
    ]);

    $ticket = \App\Models\ServiceRequest::findOrFail($id);

    $message = \App\Models\ServiceMessage::create([
        'service_request_id' => $ticket->id,
        'user_id' => auth()->id(),
        'message' => $request->message,
        'sender' => 'user',
    ]);

    return response()->json([
        'status' => true,
        'message' => $message
    ]);
});
