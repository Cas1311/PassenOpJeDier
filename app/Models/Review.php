<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'rating',
        'comments',
        'user_id',
        'sitting_request_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sittingRequest()
    {
        return $this->belongsTo(SittingRequest::class);
    }
}
