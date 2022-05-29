<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'name',
        'duration',
        'price',
        'subcategory_id',
        'business_id'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
    
    public function employees()
    {
        return $this->belongsToMany('App\Employee', 'employee_x_services', 'service_id', 'employee_id');
    }
    
    public function subCategory()
    {
        return $this->belongsTo(ServiceSubcategory::class, 'subcategory_id', 'id')->with('category');
    }
}
