<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Container;

use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class PhpGenesisContainer extends IlluminateContainer implements \Illuminate\Contracts\Foundation\Application
{
    public static function getInstance(): IlluminateContainer|PhpGenesisContainer
    {
        if (static::isLaravelApplication()) {
            return parent::getInstance();
        }

        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public static function isLaravel(): bool
    {
        return static::isLaravelApplication();
    }

    protected static function isLaravelApplication(): bool
    {
        return class_exists(Application::class);
    }

    public function version(): string
    {
        return "";
    }

    public function basePath($path = ""): string
    {
        return "";
    }

    public function bootstrapPath($path = ""): string
    {
        return "";
    }

    public function configPath($path = ""): string
    {
        return "";
    }

    public function databasePath($path = ""): string
    {
        return "";
    }

    public function langPath($path = ""): string
    {
        return "";
    }

    public function publicPath($path = "")
    {
        return "";
    }

    public function resourcePath($path = "")
    {
        return "";
    }

    public function storagePath($path = "")
    {
        return "";
    }

    public function environment(...$environments): string|bool
    {
        return "";
    }

    public function runningInConsole(): bool
    {
        return false;
    }

    public function runningUnitTests(): bool
    {
        return false;
    }

    public function hasDebugModeEnabled(): false
    {
        return false;
    }

    /** @phpstan-ignore-next-line */
    public function maintenanceMode(): bool
    {
        return false;
    }

    public function isDownForMaintenance(): bool
    {
        return false;
    }

    public function registerConfiguredProviders(): bool
    {
        return false;
    }

    /** @phpstan-ignore-next-line */
    public function register($provider, $force = false): void {}

    public function registerDeferredProvider($provider, $service = null): string
    {
        return $provider;
    }

    public function resolveProvider($provider): string|ServiceProvider
    {
        return $provider;
    }

    public function boot(): void
    {
        // TODO: Implement boot() method.
    }

    public function booting($callback): void
    {
        // TODO: Implement booting() method.
    }

    public function booted($callback): void
    {
        // TODO: Implement booted() method.
    }

    public function bootstrapWith(array $bootstrappers): void
    {
        // TODO: Implement bootstrapWith() method.
    }

    public function getLocale(): string
    {
        return "";
    }

    public function getNamespace(): string
    {
        return "";
    }

    public function getProviders($provider): array
    {
        return [];
    }

    public function hasBeenBootstrapped(): bool
    {
        return false;
    }

    public function loadDeferredProviders(): void
    {
        // TODO: Implement loadDeferredProviders() method.
    }

    public function setLocale($locale): void
    {
        // TODO: Implement setLocale() method.
    }

    public function shouldSkipMiddleware(): bool
    {
        return false;
    }

    /** @phpstan-ignore-next-line */
    public function terminating($callback): void {}

    public function terminate(): void
    {
        // TODO: Implement terminate() method.
    }
}
