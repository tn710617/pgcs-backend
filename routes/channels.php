<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::channel('messageRooms.{messageRoomId}', function (User $user, string $messageRoomId) {
    return $user->current_room_id === $messageRoomId;
}, ['guards' => ['simple']]);
