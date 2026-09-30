<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /** Hiển thị danh sách người dùng để admin quản lý. */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    // cộng tiền
    /** Cộng số dư thủ công cho một người dùng. */
    public function addMoney(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User không tồn tại'
            ]);
        }

        $amount = (int)$request->amount;

        if ($amount <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'Số tiền không hợp lệ'
            ]);
        }

        $user->balance += $amount;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Cộng tiền thành công'
        ]);
    }
    // trừ tiền
    /** Trừ số dư người dùng nhưng không cho phép số dư âm. */
    public function minusMoney(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $user = User::findOrFail($id);

        if ($user->balance < $request->amount) {
            return response()->json([
                'status' => false,
                'message' => 'Số dư user không đủ để trừ'
            ]);
        }

        $user->balance -= $request->amount;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Trừ tiền thành công'
        ]);
    }
}
