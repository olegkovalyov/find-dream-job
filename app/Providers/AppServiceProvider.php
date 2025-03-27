<?php

namespace App\Providers;

use App\Services\Concrete\ApplicantService;
use App\Services\Concrete\BookmarkService;
use App\Services\Concrete\JobService;
use App\Services\Concrete\MapService;
use App\Services\Concrete\ProfileService;
use App\Services\Contracts\ApplicantServiceInterface;
use App\Services\Contracts\BookmarkServiceInterface;
use App\Services\Contracts\JobServiceInterface;
use App\Services\Contracts\MapServiceInterface;
use App\Services\Contracts\ProfileServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        ApplicantServiceInterface::class => ApplicantService::class,
        BookmarkServiceInterface::class => BookmarkService::class,
        JobServiceInterface::class => JobService::class,
        MapServiceInterface::class => MapService::class,
        ProfileServiceInterface::class => ProfileService::class,
    ];

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
        //
    }
}
