<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;

class AccountApiController extends Controller
{
/**
 * API danh sách tài khoản chưa bán, hỗ trợ lọc theo slug danh mục.
 * Controller này hiện không được routes/api.php sử dụng trực tiếp.
 */
public function index(Request $request)
{
    $query = \App\Models\Account::with('category')
        ->where('status', '!=', 'sold'); // 🔥 THÊM DÒNG NÀY

    // FILTER CATEGORY
    if ($request->category) {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    return response()->json($query->get());
}
}
