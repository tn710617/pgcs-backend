<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Http\Requests\MessageCreateRequest;
use App\Http\Resources\MessageCollection;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function store(MessageCreateRequest $request)
    {
        $user = Auth::guard('simple')->user();

        abort_if(is_null($user->current_room_id), 403);

        $message = Message::create([
            'message_content' => $request->input('message_content'),
            'message_room_id' => $user->current_room_id
        ]);

        broadcast(new MessageCreated($message))->toOthers();

        return response()->json('', 201);
    }

    public function index()
    {
        $user = Auth::guard('simple')->user();

        abort_if(is_null($user->currentMessageRoom), 403);

        $messages = $user->currentMessageRoom->messages()->take(5)->orderByDesc('created_at')->get()->sort();

        return MessageCollection::make($messages);
    }
}
