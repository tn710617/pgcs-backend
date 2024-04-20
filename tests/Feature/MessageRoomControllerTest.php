<?php

namespace Tests\Feature;

use App\Models\MessageRoom;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageRoomControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_can_create_or_enter_message_room()
    {
        $expectation = [
            'room_name' => 'Test Room',
            'user_id' => User::factory()->create()->id
        ];

        $this->post(route('message-rooms.create-or-enter'), $expectation)
            ->assertNoContent();

        $this->assertDatabaseHas('message_rooms', [
            'room_name' => $expectation['room_name']
        ]);

        $user = User::find($expectation['user_id']);
        $messageRoom = MessageRoom::query()->whereRoomName($expectation['room_name'])->first();

        $this->assertTrue($user->currentMessageRoom->is($messageRoom));
    }
}
