<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
/** Danh mục nền tảng/dịch vụ mà tài khoản đang thuộc về. */
public function category()
{
    return $this->belongsTo(Category::class);
}
protected $fillable = [
    'title',
    'username',
    'price',
    'category_id'
];
/** Các đơn hàng đã phát sinh từ tài khoản này. */
public function orders()
{
    return $this->hasMany(Order::class);
}
}
