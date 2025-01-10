<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Laravel\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if (!function_exists("base_path")) {
            return;
        }

        $composerJsonPath = base_path("composer.json");
        $composerConfig = file_get_contents($composerJsonPath);

        if (!is_string($composerConfig)) {
            return;
        }

        $composerConfig = json_decode($composerConfig, true);

        if (isset($composerConfig["extra"]["laravel"]["providers"])) {
            foreach ($composerConfig["extra"]["laravel"]["providers"] as $provider) {
                $this->app->register($provider);
            }
        }

        if (isset($composerConfig["extra"]["laravel"]["aliases"])) {
            foreach ($composerConfig["extra"]["laravel"]["aliases"] as $alias => $class) {
                $this->app->alias($class, $alias);
            }
        }
    }

    public function boot(): void
    {
        // Method left intentionally empty
    }
}