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
     * Bootstrap any application services.
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