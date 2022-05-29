<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'ambient',
        'cleanliness',
        'service',
        'average',
        'comment',
        'token',
        'customer_id',
        'service_id',
        'status',
        'user_id'
    ];

    public function business()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id')->with('customer');
    }
}
