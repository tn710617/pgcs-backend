<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRoomCreateOrEnterRequest;
use App\Models\MessageRoom;
use App\Models\User;

class MessageRoomController extends Controller
{

    public function createOrEnter(MessageRoomCreateOrEnterRequest $request)
    {
        $user = User::find($request->input('user_id'));

        $room = MessageRoom::query()->firstOrCreate([
            'room_name' => $request->input('room_name')
        ]);

        $user->update([
            'current_room_id' => $room->getKey()
        ]);

        return response()->noContent();
    }
}
