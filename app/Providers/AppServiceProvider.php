<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Auth::viaRequest('simple', function (Request $request) {
            Log::info('log detail', [
                'bearer' => $request->bearerToken(),
                'route' => $request->route()->uri,
            ]);

            if (!$request->bearerToken()) {
                return null;
            }

            $user = User::find($request->bearerToken());
            return User::find($request->bearerToken());
        });
    }
}
