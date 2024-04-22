<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\MessageRoomController;
use App\Http\Controllers\MessageController;

Route::post('users/register', [UserAuthController::class, 'register'])->name('users.auth.register');

Route::group(['middleware' => 'auth:simple'], function () {
    Route::post('message-rooms/create-or-enter',
        [MessageRoomController::class, 'createOrEnter'])->name('message-rooms.create-or-enter');
    Route::apiResource('messages', MessageController::class)->only(['store', 'index']);
    Route::get('users/self', [UserAuthController::class, 'getSelf'])->name('users.auth.get-self');
});
