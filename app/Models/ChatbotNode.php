<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotNode extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'mensaje'];

    public function opciones(){
        return $this->hasMany(Option::class, "chatbot_node_id", "id");
    }
}
