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

    /** Ticket hỗ trợ chứa tin nhắn này. */
    public function request()
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id');
    }

    /** Người gửi tin nhắn; có thể null đối với tin nhắn AI. */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
