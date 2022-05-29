<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    public $table = 'bookings';

    public $fillable = [
        'start',
        'end',
        'title',
        'class',
        'employee_id',
        'customer_id',
        'transaction_id',
        'service_id',
        'total_price',
        'total_duration',
        'created_at',
        'updated_at',
        'reminder_24hs_sent',
        'reminder_2hs_sent'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id')->with('business');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
