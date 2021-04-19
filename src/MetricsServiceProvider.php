<?php

namespace DeDmytro\Metrics;

use DeDmytro\Metrics\Commands\Install;
use DeDmytro\Metrics\Entities\MetricCacheRecord;
use DeDmytro\Metrics\Services\MetricsCacheManager;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Psr\SimpleCache\InvalidArgumentException;

final class MetricsServiceProvider extends BaseServiceProvider
{
    /**
     * Boot resources and cache manager
     * @throws InvalidArgumentException
     */
    public function boot(): void
    {
        $this->bootPublishes();
        $this->bootTranslations();

        if (config('metrics.cache_enabled')) {
            MetricsCacheManager::init();
        }
    }

    /**
     * Register resources
     */
    public function register(): void
    {
        $this->registerConfig();
        $this->registerRoutes();
        $this->registerViews();

        if ($this->app->runningInConsole()) {
            $this->registerConsoleCommands();
        }

    }

    /**
     * Boot config and public
     */
    protected function bootPublishes(): void
    {
        $this->publishes([
            __DIR__.'/../config/metrics.php' => $this->app->configPath('metrics.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/metrics'),
        ], 'public');
    }

    /**
     * Boot translations
     */
    protected function bootTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'metrics');
    }

    /**
     * Register config
     */
    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/metrics.php', 'metrics');
    }

    /**
     * Register the package routes.
     * @return void
     */
    protected function registerRoutes()
    {
        Route::prefix(config('metrics.path'))->middleware(config('metrics.middleware'))->group(function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    /**
     * Register the package views.
     * @return void
     */
    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'metrics');
    }

    /**
     * Register package commands
     * @return void
     */
    protected function registerConsoleCommands()
    {
        $this->commands(Install::class);
    }
}
