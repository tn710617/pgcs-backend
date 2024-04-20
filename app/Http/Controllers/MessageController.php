<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageCreateRequest;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{

    public function create(MessageCreateRequest $request)
    {
        $user = User::find($request->input('user_id'));

        abort_if(is_null($user->current_room_id), 403);

        Message::create([
            'message_content' => $request->input('message_content'),
            'message_room_id' => $user->current_room_id
        ]);

        return response()->json('', 201);
    }
}
