<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;

Route::post('register', [UserAuthController::class, 'register'])->name('users.auth.register');
