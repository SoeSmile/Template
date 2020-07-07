<?php

namespace App\Providers;

use App\Library\Services\AppexNpayApi\AppexNpayApi;
use GuzzleHttp\Client;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppexNpayApiServiceProvider
 * @package App\Providers
 */
class AppexNpayApiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AppexNpayApi::class, function () {

            return new AppexNpayApi(new Client(), config('services.appex_npay.url'));
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            AppexNpayApi::class
        ];
    }
}
