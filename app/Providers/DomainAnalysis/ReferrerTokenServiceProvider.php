<?php

namespace App\Providers\DomainAnalysis;

use App\Http\Helpers\ReferrerRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ReferrerTokenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ReferrerRepository::class, function () {
            $key = $this->app['config']['app.key'] ?? '';

            if (Str::startsWith($key, 'base64:')) {
                $key = base64_decode(substr($key, 7));
            }

            return new ReferrerRepository($this->app['hash'], $key);
        });
    }
}
