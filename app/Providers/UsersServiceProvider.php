<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Resources\UsersXMLResource;
use App\Interfaces\UsersService;
use App\Interfaces\UsersResource;
use App\Services\RandomUserApiService;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UsersService::class, RandomUserApiService::class);
        $this->app->bind(UsersResource::class, UsersXMLResource::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
