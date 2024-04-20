<?php

namespace Tests\Feature;

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
}
