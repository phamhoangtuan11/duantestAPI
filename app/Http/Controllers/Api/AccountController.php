<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::with('category')->get();
        return response()->json($accounts);
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
