<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderApiController extends Controller
{
/**
 * Mua tài khoản trong transaction.
 *
 * lockForUpdate ngăn hai người mua cùng một tài khoản. Giao dịch sẽ kiểm tra
 * số dư, trừ tiền, đánh dấu tài khoản đã bán và lưu thông tin bàn giao.
 */
 public function buy($id)
{
    if (!Auth::check()) {
        return response()->json([
            'status' => false,
            'message' => 'Chưa đăng nhập'
        ]);
    }

    $user = Auth::user();

    DB::beginTransaction();

    try {
        $account = Account::where('id', $id)->lockForUpdate()->first();

        if (!$account) {
            return response()->json([
                'status' => false,
                'message' => 'Không tồn tại acc'
            ]);
        }

        if ($account->status == 1) {
            return response()->json([
                'status' => false,
                'message' => 'Acc đã bán'
            ]);
        }

        if ($user->balance < $account->price) {
            return response()->json([
                'status' => false,
                'message' => 'Số dư không đủ'
            ]);
        }

        // trừ tiền
        $user->balance -= $account->price;
        $user->save();

        // đánh dấu acc đã bán
        $account->status = 1;
        $account->save();

        // tạo order
        Order::create([
            'user_id' => $user->id,
            'account_id' => $account->id,
            'username' => $account->username,
            'password' => $account->password,
            'price' => $account->price,
            'status' => 'done'
        ]);

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Mua thành công',
            'data' => [
                'username' => $account->username,
                'password' => $account->password
            ]
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}
}
