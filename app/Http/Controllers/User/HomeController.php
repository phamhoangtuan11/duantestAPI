<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** Hiển thị trang home riêng của khu vực người dùng. */
    public function index()
    {
        return view('user.home');
    }
}
