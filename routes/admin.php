<?php
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route:: middleware(['auth', 'checkrole:admin'])
    -> prefix('admin')
    ->group(function (){
        Route::get ('/dashboard', [DashboardController::class, 'index']);
    });