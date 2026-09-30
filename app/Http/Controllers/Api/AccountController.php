<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    /**
     * Trả danh sách tài khoản dưới dạng JSON, hỗ trợ lọc theo danh mục.
     */
    public function index(Request $request)
{
    $query = Account::with('category');

    // nếu có category thì lọc
    if ($request->category) {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    return response()->json($query->get());
}

    /**
     * Tạo tài khoản mới qua API sau khi kiểm tra dữ liệu đầu vào.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id'
    ]);
    $account = Account::create([
        'title' => $request->title,
        'username' => $request->username,
        'price' => $request->price,
        'category_id' => $request->category_id
    ]);

    return response()->json([
        'message' => 'Tạo account thành công',
        'data' => $account
    ]);
}

    /**
     * Điểm mở rộng trả chi tiết tài khoản; hiện chưa triển khai.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Cập nhật tài khoản và trả lỗi 404 nếu không tồn tại.
     */
    public function update(Request $request, string $id)
    {
        $account = Account::find($id);
        if(!$account){
            return response()->json([
                'message' =>' không tìm thấy account'
            ], 404);
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);
        $account->update([
            'title' => $request->title,
            'username' => $request->username,
            'price' => $request->price,
            'category_id' => $request->category_id
        ]);
        return response()->json([
            'message' => ' cập nhật thành công',
            'data' => $account
        ]);
    }

    /**
     * Xóa tài khoản và trả lỗi 404 nếu không tồn tại.
     */
    public function destroy(string $id)
    {
        $account = Account::find($id);
        if(!$account){
            return response()->json([
                'message' =>' không tìm thấy account'
            ], 404);
        }
        $account->delete();
        return response()->json([
            'message'=> 'xóa thành công'
        ]);
    }
}
