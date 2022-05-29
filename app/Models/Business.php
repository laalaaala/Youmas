<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'branch_id',
        'person_to_contact',
        'ust_id',
        'user_id'
    ];


    public function pictures()
    {
        return $this->hasMany(BusinessPicture::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->with('location')->with('reviews');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class)->with('services')->with('workingHours');
    }

    public function services()
    {
        return $this->hasMany(Service::class)->with('subCategory');
    }

    public function openingHours()
    {
        return $this->hasMany(BusinessOpeningHours::class);
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'user_x_favorites', 'business_id', 'user_id');
    }

  
}
