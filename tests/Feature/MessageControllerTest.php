<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\MessageRoom;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_can_create_message()
    {
        $this->withoutExceptionHandling();

        $expectation = [
            'message_content' => '1.1111,-1.1111',
            'user_id' => User::factory()->create([
                'current_room_id' => MessageRoom::factory()->create()->id
            ])->id
        ];

        $this->post(route('messages.create'), $expectation)
            ->assertCreated();

        $this->assertDatabaseHas('messages', [
            'message_content' => $expectation['message_content'],
            'message_room_id' => User::find($expectation['user_id'])->currentMessageRoom->id
        ]);
    }

    public function test_can_index_messages()
    {
        $expectation = [
            'user_id' => User::factory()->create([
                'current_room_id' => MessageRoom::factory()->create()->id
            ])->id
        ];

        $room = User::find($expectation['user_id'])->currentMessageRoom;

        $messages = Message::factory()->count(10)->create([
            'message_room_id' => $room->id
        ])->sortByDesc('created_at');

        $this->get(route('messages.index', $expectation))
            ->assertJsonCount(5, 'data')
            ->assertJson([
                'data' => [
                    [
                        'id' => $messages[0]->id,
                        'message_content' => $messages[0]->message_content,
                        'created_at' => $messages[0]->created_at->toDateTimeString(),
                    ],
                    [
                        'id' => $messages[1]->id,
                        'message_content' => $messages[1]->message_content,
                        'created_at' => $messages[1]->created_at->toDateTimeString(),
                    ],
                    [
                        'id' => $messages[2]->id,
                        'message_content' => $messages[2]->message_content,
                        'created_at' => $messages[2]->created_at->toDateTimeString(),
                    ],
                    [
                        'id' => $messages[3]->id,
                        'message_content' => $messages[3]->message_content,
                        'created_at' => $messages[3]->created_at->toDateTimeString(),
                    ],
                    [
                        'id' => $messages[4]->id,
                        'message_content' => $messages[4]->message_content,
                        'created_at' => $messages[4]->created_at->toDateTimeString(),
                    ]
                ]
            ]);
    }
}
