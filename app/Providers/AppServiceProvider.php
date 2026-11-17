<?php

namespace App\Providers;

use App\Contracts\SmsGateway;
use App\Services\UnconfiguredSmsGateway;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SmsGateway::class, UnconfiguredSmsGateway::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('donor-registration', function (Request $request): Limit {
            return Limit::perMinute((int) config('donor.registration.rate_limit_per_minute', 5))
                ->by('donor-registration:'.$request->ip());
        });
    }
}
