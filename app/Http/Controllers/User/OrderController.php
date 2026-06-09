<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use App\Models\Order;

class OrderController extends Controller
{
   public function buy($id)
{
    try {
        DB::beginTransaction();

        $account = Account::where('id', $id)->lockForUpdate()->first();

        if (!$account) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy'
            ], 404);
        }

        if ($account->status === 'sold') {
            return response()->json([
                'status' => false,
                'message' => 'Đã bán'
            ], 400);
        }

        Order::create([
            'user_id' => auth()->id(),
            'account_id' => $account->id,
            'price' => $account->price,
            'status' => 'pending'
        ]);

        $account->update([
            'status' => 'sold'
        ]);

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Mua thành công'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
public function checkout($id)
{
    $account = Account::findOrFail($id);

    return view('checkout', compact('account'));
}
public function myOrders()
{
    $orders = Order::latest()->get(); // tạm lấy tất cả

    return view('orders', compact('orders'));
}
}
