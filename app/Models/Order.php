<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Account;

class Order extends Model
{
    protected $fillable = [
    'user_id',
    'account_id',
    'username',
    'password',
    'price',
    'status'
];

    // 🔗 order thuộc về user
    /** Người dùng đã mua và sở hữu đơn hàng. */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 order thuộc về account
    /** Tài khoản gốc được dùng để tạo đơn hàng. */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
