<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeWorkingHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'end',
        'title',
        'class',
        'employee_id',
        'employee_name',
        'created_at',
        'updated_at'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
