<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'business_id',
        'profile_picture',
        'genre',
        'created_at',
        'updated_at'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class)->with('user');
    }

    public function workingHours()
    {
        return $this->hasMany(EmployeeWorkingHours::class);
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'employee_x_services', 'employee_id', 'service_id');
    }
}
