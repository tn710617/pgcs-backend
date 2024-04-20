<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\MessageRoomController;
use App\Http\Middleware\AuthenticateUser;
use App\Http\Controllers\MessageController;

Route::post('users/register', [UserAuthController::class, 'register'])->name('users.auth.register');

Route::group(['middleware' => AuthenticateUser::class], function () {
    Route::post('message-rooms/create-or-enter',
        [MessageRoomController::class, 'createOrEnter'])->name('message-rooms.create-or-enter');
    Route::post('messages/create', [MessageController::class, 'create'])->name('messages.create');
});
