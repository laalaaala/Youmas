<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBookingHours extends Model
{
    use HasFactory;

    public $table = 'employee_bookings';

    public $fillable = [
        'start',
        'end',
        'title',
        'class',
        'employee_id',
        'customer_id',
        'transaction_id',
        'created_at',
        'updated_at',
    ];
}
