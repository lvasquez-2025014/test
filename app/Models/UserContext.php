<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserContext extends Model
{
    protected $fillable = ['phone_number', 'nombre', 'current_node', 'ai_history'];

    protected $casts = [
        'ai_history' => "array"
    ];
}
