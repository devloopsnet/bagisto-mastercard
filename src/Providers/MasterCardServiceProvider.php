<?php

namespace Devloops\MasterCard\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class MasterCardServiceProvider
 *
 * @package Devloops\MasterCard\Providers
 * @date 29/09/2021
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class MasterCardServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        include __DIR__.'/../Http/routes.php';

        $this->readPublishableAssets();
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'mastercard');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'mastercard');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerConfig();
    }

    /**
     * @return void
     */
    private function readPublishableAssets(): void
    {
        $this->publishes([
            __DIR__.'/../Resources/views/mastercard' => resource_path('vendor/mastercard'),
        ]);

        $this->publishes([__DIR__.'/../Resources/lang' => resource_path('lang/vendor/mastercard')]);
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(dirname(__DIR__).'/Config/paymentmethods.php', 'paymentmethods');

        $this->mergeConfigFrom(dirname(__DIR__).'/Config/system.php', 'core');
    }

}
