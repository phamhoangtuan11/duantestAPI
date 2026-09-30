<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'platform',
    'service',
    'contact',
    'account_info',
    'description',
    'status'
];
/** Toàn bộ tin nhắn thuộc ticket, gồm user, AI và admin. */
public function messages()
{
    return $this->hasMany(\App\Models\ServiceMessage::class);
}

/** Người dùng đã tạo ticket; có thể null nếu khách chưa đăng nhập. */
public function user()
{
    return $this->belongsTo(User::class);
}
}
