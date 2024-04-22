<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRoomCreateOrEnterRequest;
use App\Models\MessageRoom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageRoomController extends Controller
{

    public function createOrEnter(MessageRoomCreateOrEnterRequest $request)
    {
        $user = Auth::guard('simple')->user();

        $room = MessageRoom::query()->firstOrCreate([
            'room_name' => $request->input('room_name')
        ]);

        $user->update([
            'current_room_id' => $room->getKey()
        ]);

        return response()->noContent();
    }

    public function leave()
    {
        $user = Auth::guard('simple')->user();

        $user->update([
            'current_room_id' => null
        ]);

        return response()->noContent();
    }
}
