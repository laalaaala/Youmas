<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'detail',
        'slug',
        'created_at',
        'updated_at',
        'user_id'
    ];

    public function user()
    {
        $this->belongsTo('App\User');
    }
}
