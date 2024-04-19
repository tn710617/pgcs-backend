<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserAuthController extends Controller
{

    public function register(UserAuthRegisterRequest $request)
    {
        // Get fake factory
        $faker = \Faker\Factory::create();

        $secret = $request->input('secret');

        abort_if($secret !== config('custom.secret'), 403);

        $randomUserName = $faker->userName().'_'.mt_rand(100000, 999999);

        $user = User::create([
            'user_name' => $randomUserName,
            'current_room_id' => null
        ]);

        return UserResource::make($user);
    }
}
