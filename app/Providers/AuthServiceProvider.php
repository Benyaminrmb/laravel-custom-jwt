<?php

namespace App\Providers;

use App\Services\AuthGuards\JWTGuard;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Auth::extend('jwt', function ($app, $name, array $config) {
            $accessTokenEncrypter = new Encrypter(config('jwt.private_key'), 'aes-256-cbc');
            $refreshTokenEncrypter = new Encrypter(config('jwt.refresh_private_key'), 'aes-256-cbc');
            return new JWTGuard(
                Auth::createUserProvider($config['provider']),
                $accessTokenEncrypter,
                $refreshTokenEncrypter,  // Use the same encrypter for refresh tokens (optional)
                $app->make('request')
            );
        });
    }
}
