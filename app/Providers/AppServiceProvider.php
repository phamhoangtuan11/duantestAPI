<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use App\Models\User;
use App\Models\Account;
use App\Models\Order;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Chia sẻ thống kê tổng quan cho toàn bộ view thuộc khu vực admin.
     * Nhờ đó sidebar/layout admin có thể dùng số liệu mà không truy vấn lại ở từng view.
     */
    public function boot(): void
    {
        View::composer('admin.*', function ($view) {

            $view->with([

                'totalUsers' => User::count(),

                'totalAccounts' => Account::count(),

                'totalOrders' => Order::count(),

                'totalRevenue' => Order::sum('price'),

            ]);

        });
    }
}
