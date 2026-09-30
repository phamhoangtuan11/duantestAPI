<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /** Hiển thị toàn bộ danh mục tài khoản cho admin. */
    public function index(){
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /** Tạo danh mục mới dùng để phân loại tài khoản bán. */
    public function store(Request $request){
        $request-> validate([
            'name' => 'required',
            'slug' => 'required'
        ]);

        Category::create($request->all());
        return back()->with('success', 'Thêm thành công ');
    }

    /** Cập nhật tên và slug của danh mục theo id. */
    public function update(Request $request, $id){
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return back()->with('success', 'cập nhật thành công');
    }

    /** Xóa danh mục và để database xử lý dữ liệu liên quan. */
    public function destroy($id){
        Category::findOrFail($id)->delete();
        return back()->with('success', 'xóa thành công');
    }
}
