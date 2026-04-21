<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function index(){
        $accounts = Account::with('category')->get();
        return view('admin.accounts.index', compact('accounts'));
    }
}
