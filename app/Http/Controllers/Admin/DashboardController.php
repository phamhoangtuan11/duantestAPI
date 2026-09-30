<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Account;
use App\Models\Order;

class DashboardController extends Controller
{
    /** Tổng hợp số liệu toàn hệ thống để hiển thị trên dashboard admin. */
    public function index()
    {
        return view('admin.dashboard', [

            'totalUsers' => User::count(),

            'totalAccounts' => Account::count(),

            'totalOrders' => Order::count(),

            'totalRevenue' => Order::sum('price'),

        ]);
    }
}
