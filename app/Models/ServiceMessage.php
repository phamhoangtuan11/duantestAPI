<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceMessage extends Model
{
    protected $fillable = [
        'service_request_id',
        'user_id',
        'message',
        'sender',
    ];

    public function request()
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}