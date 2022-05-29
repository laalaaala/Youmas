<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPicture extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'order',
        'business_id'
    ];

    public function business() {
        return $this->belongsTo(Business::class);
    }
}
