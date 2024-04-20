<?php

namespace Tests\Feature;

use App\Models\MessageRoom;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAuthControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_can_get_self_info()
    {
        $user = User::factory([
            'current_room_id' => MessageRoom::factory()->create()
        ])->create();

        $this->getJson(route('users.auth.get-self', ['user_id' => $user->id]))
            ->assertJson([
                'data' => [
                    'id' => $user->id,
                    'user_name' => $user->user_name,
                    'current_room' => [
                        'id' => $user->currentMessageRoom->id,
                        'room_name' => $user->currentMessageRoom->room_name,
                    ]
                ]
            ]);
    }

    public function test_can_register()
    {
        $expectation = [
            'secret' => config('custom.secret')
        ];

        $this->postJson(route('users.auth.register'), [
            'secret' => $expectation['secret']
        ])->assertJsonStructure([
            'data' => [
                'id',
                'user_name'
            ]
        ]);
    }
}
