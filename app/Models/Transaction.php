<?php

namespace App\Models;

use App\Events\TransactionCompleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'youmas_revenue',
        'business_revenue',
        'status',
        'amount',
        'customer_id',
        'business_id',
        'order_id',
    ];
    protected $dispatchesEvents = [
        'updated' => TransactionCompleted::class,
    ];


    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function business()
    {
        return $this->belongsTo(User::class, 'business_id');
    }
}
