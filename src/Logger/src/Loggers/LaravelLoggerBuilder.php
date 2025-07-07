<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger\Loggers;

use Illuminate\Log\LogManager;
use Illuminate\Support\Facades\Facade;
use PHPGenesis\Common\Attributes\Internal;
use PHPGenesis\Common\Container\PHPGenesisContainer;
use PHPGenesis\Logger\Config\LoggerConfig;

/** @internal */
#[Internal]
class LaravelLoggerBuilder
{
    protected static LaravelLoggerBuilder $instance;
    protected PHPGenesisContainer $container;

    public function __construct()
    {
        if (!PHPGenesisContainer::isLaravel()) {
            $this->container = PHPGenesisContainer::getInstance();

            $this->container->singleton("log", function (): LogManager {
                $logManager = new LogManager($this->container);
                $this->mergeJsonConfig();

                return $logManager;
            });

            Facade::setFacadeApplication($this->container);
        }
    }

    public static function make(): LaravelLoggerBuilder
    {
        if (!isset(static::$instance)) {
            static::$instance = new self;
        }

        return static::$instance;
    }

    protected function mergeJsonConfig(): void
    {
        $loggerConfig = LoggerConfig::get();

        $loggerConfig = json_encode($loggerConfig);
        if ($loggerConfig) {
            $loggerConfig = json_decode($loggerConfig, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $currentConfig = $this->container->getBindings()["config"];
                $currentLoggingConfig = $currentConfig["logging"];
                $mergedLoggingConfig = array_merge($currentLoggingConfig, $loggerConfig);
                $mergedConfig = array_merge($currentConfig, $mergedLoggingConfig);
                $this->container->bind("config", function () use ($mergedConfig): array {
                    return $mergedConfig;
                });
            }
        }

    }
}