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
public function messages()
{
    return $this->hasMany(\App\Models\ServiceMessage::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
