<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request){
        $request-> validate([
            'name' => 'required',
            'slug' => 'required'
        ]);

        Category::create($request->all());
        return back()->with('success', 'Thêm thành công ');
    }

    public function update(Request $request, $id){
        $category = Category::find0rFail($id);
        $category-> update($request->all());
        return back()->with('success', 'cập nhật thành công');
    }

    public function destroy($id){
        Category::findOrFail($id)->delete();
        return back()->with('success', 'xóa thành công');
    }
}
