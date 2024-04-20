<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MessageRoom extends Model
{

    use HasFactory, HasUlids;

    protected $fillable = [
        'room_name'
    ];

    /**
     * Relations
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
