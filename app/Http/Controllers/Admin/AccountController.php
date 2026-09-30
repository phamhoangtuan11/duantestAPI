<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Category;

class AccountController extends Controller
{
    /** Hiển thị danh sách tài khoản bán và hỗ trợ lọc theo danh mục. */
    public function index(Request $request)
    {
        $accounts = Account::with('category');
        $categories = Category::all();
        // fillter theo category
        if ($request->category_id) {
        $accounts->where('category_id', $request->category_id);
    }
    $accounts = $accounts->get();
        return view('admin.accounts.index', compact('accounts', 'categories'));
    }

    /** Tạo tài khoản mới để bán trên hệ thống. */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'username' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required'
        ]);

        Account::create($request->all());

        return back()->with('success', 'Thêm thành công');
    }

    /** Cập nhật thông tin tài khoản bán theo id. */
    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);

        $account->update($request->all());

        return back()->with('success', 'Cập nhật thành công');
    }

    /** Xóa tài khoản bán khỏi hệ thống. */
    public function destroy($id)
    {
        Account::findOrFail($id)->delete();

        return back()->with('success', 'Xoá thành công');
    }
}
