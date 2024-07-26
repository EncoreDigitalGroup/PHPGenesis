<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Container;

use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Foundation\Application;

/** @experimental */
class PhpGenesisContainer extends IlluminateContainer
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

    public function isLaravel(): bool
    {
        return static::isLaravelApplication();
    }
}
