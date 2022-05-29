<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'status',
        'conversation_id',
        'created_at',
        'updated_at'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'conversation_x_users', 'conversation_id', 'user_id' );
    }

    public function messages()
    {
        return $this->hasMany(ConversationMessage::class, 'conversation_id');
    }
}
