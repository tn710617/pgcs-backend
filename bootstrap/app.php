<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LogReqRes;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Carbon;
use App\Models\Message;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )->withMiddleware(function (Middleware $middleware) {
        $middleware->append(LogReqRes::class);
    })->withExceptions(function (Exceptions $exceptions) {
        //
    })->withSchedule(function (Schedule $schedule) {
        $schedule->call(function () {
            $deadline = Carbon::yesterday()->toDateTimeString();
            Message::query()->where('created_at', '<', $deadline)->delete();
        })->daily();
    })->create();
