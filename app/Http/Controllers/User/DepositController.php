<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
   public function index()
{
    return view('deposit');
}

public function store(Request $request)
{
    $amount = $request->amount;

    if ($amount <= 0) {
        return back()->with('error', 'Số tiền không hợp lệ');
    }

    $user = Auth::user();

    $user->balance += $amount;
    $user->save();

    return back()->with('success', 'Nạp tiền thành công!');
}
}
