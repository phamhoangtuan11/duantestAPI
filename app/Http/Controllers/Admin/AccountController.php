<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Category;

class AccountController extends Controller
{
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

    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);

        $account->update($request->all());

        return back()->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        Account::findOrFail($id)->delete();

        return back()->with('success', 'Xoá thành công');
    }
}