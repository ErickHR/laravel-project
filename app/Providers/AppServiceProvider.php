<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\PersonalAccessToken;

use App\Feature\Login\Domain\Repository\UserRepository;
use App\Feature\Login\Domain\UseCase\LoginUseCase;
use App\Feature\Login\Infraestructure\UserRepositoryImpl;
use App\Feature\Login\Presentation\LoginUseCaseImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);

        $this->app->bind(LoginUseCase::class, function () {
            return new LoginUseCaseImpl($this->app->make(UserRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
