<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    use HasFactory, HasUlids;

    protected $fillable = [
        'message_content',
        'message_room_id',
    ];

    protected $casts = [
        'message_room_id' => 'string',
    ];
}
