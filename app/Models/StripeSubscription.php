<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeSubscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'subscription_id',
        'product_id',
        'plan_name',
        'plan_price',
        'start_date',
        'due_date',
        'card_digits',
        'card_expires',
        'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
