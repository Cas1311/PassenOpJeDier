<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SittingRequest extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'hourly_rate',
        'notes',
        'user_id',
        'pet_id',
        'accepted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
