<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'id',
        'chabot_node_id',
        'key',
        'text',
        'respuesta',
        'next_node_id'
    ];

    protected $casts = [
        'respuesta' => 'array'
    ];
}
