<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAuthControllerTest extends TestCase
{

    use RefreshDatabase;

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
