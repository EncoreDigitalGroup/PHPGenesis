<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Container;

use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Foundation\Application;

/** @experimental */
class PhpGenesisContainer extends IlluminateContainer implements \Illuminate\Contracts\Foundation\Application
{
    public static function getInstance(): IlluminateContainer|PhpGenesisContainer
    {
        if (static::isLaravelApplication()) {
            return parent::getInstance();
        }

        if (is_null(static::$instance)) {
            static::$instance = new static(); //@phpstan-ignore-line
        }

        return static::$instance;
    }

    protected static function isLaravelApplication(): bool
    {
        return class_exists(Application::class);
    }

    public static function isLaravel(): bool
    {
        return static::isLaravelApplication();
    }

    public function version()
    {
        // TODO: Implement version() method.
    }

    public function basePath($path = '')
    {
        // TODO: Implement basePath() method.
    }

    public function bootstrapPath($path = '')
    {
        // TODO: Implement bootstrapPath() method.
    }

    public function configPath($path = '')
    {
        // TODO: Implement configPath() method.
    }

    public function databasePath($path = '')
    {
        // TODO: Implement databasePath() method.
    }

    public function langPath($path = '')
    {
        // TODO: Implement langPath() method.
    }

    public function publicPath($path = '')
    {
        // TODO: Implement publicPath() method.
    }

    public function resourcePath($path = '')
    {
        // TODO: Implement resourcePath() method.
    }

    public function storagePath($path = '')
    {
        // TODO: Implement storagePath() method.
    }

    public function environment(...$environments)
    {
        // TODO: Implement environment() method.
    }

    public function runningInConsole()
    {
        // TODO: Implement runningInConsole() method.
    }

    public function runningUnitTests()
    {
        // TODO: Implement runningUnitTests() method.
    }

    public function hasDebugModeEnabled()
    {
        // TODO: Implement hasDebugModeEnabled() method.
    }

    public function maintenanceMode()
    {
        // TODO: Implement maintenanceMode() method.
    }

    public function isDownForMaintenance()
    {
        // TODO: Implement isDownForMaintenance() method.
    }

    public function registerConfiguredProviders()
    {
        // TODO: Implement registerConfiguredProviders() method.
    }

    public function register($provider, $force = false)
    {
        // TODO: Implement register() method.
    }

    public function registerDeferredProvider($provider, $service = null)
    {
        // TODO: Implement registerDeferredProvider() method.
    }

    public function resolveProvider($provider)
    {
        // TODO: Implement resolveProvider() method.
    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }

    public function booting($callback)
    {
        // TODO: Implement booting() method.
    }

    public function booted($callback)
    {
        // TODO: Implement booted() method.
    }

    public function bootstrapWith(array $bootstrappers)
    {
        // TODO: Implement bootstrapWith() method.
    }

    public function getLocale()
    {
        // TODO: Implement getLocale() method.
    }

    public function getNamespace()
    {
        // TODO: Implement getNamespace() method.
    }

    public function getProviders($provider)
    {
        // TODO: Implement getProviders() method.
    }

    public function hasBeenBootstrapped()
    {
        // TODO: Implement hasBeenBootstrapped() method.
    }

    public function loadDeferredProviders()
    {
        // TODO: Implement loadDeferredProviders() method.
    }

    public function setLocale($locale)
    {
        // TODO: Implement setLocale() method.
    }

    public function shouldSkipMiddleware()
    {
        // TODO: Implement shouldSkipMiddleware() method.
    }

    public function terminating($callback)
    {
        // TODO: Implement terminating() method.
    }

    public function terminate()
    {
        // TODO: Implement terminate() method.
    }
}
