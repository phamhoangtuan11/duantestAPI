<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /** Danh sách tài khoản bán thuộc danh mục. */
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
    protected $fillable = [
    'name',
    'slug'
];
}
