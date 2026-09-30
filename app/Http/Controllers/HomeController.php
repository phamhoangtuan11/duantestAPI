<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class HomeController extends Controller
{
  /** Tải trang chủ cùng danh sách tài khoản và danh mục liên quan. */
  public function index()
    {
        $accounts = Account::with('category')->get();

        return view('home', compact('accounts'));
    }
}
