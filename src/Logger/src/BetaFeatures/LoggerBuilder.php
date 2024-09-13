<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger\BetaFeatures;

use Illuminate\Log\LogManager;
use Illuminate\Support\Facades\Facade;
use PHPGenesis\Common\Container\PhpGenesisContainer;
use PHPGenesis\Logger\Config\LoggerConfig;

/** @internal */
class LoggerBuilder
{
    protected static LoggerBuilder $instance;
    protected PhpGenesisContainer $container;

    public function __construct()
    {
        if (!PhpGenesisContainer::isLaravel()) {
            $this->container = PhpGenesisContainer::getInstance();

            $this->container->singleton('log', function () {
                $logManager = new LogManager($this->container);

                if (LoggerConfig::get()->betaFeatures->facade) {
                    $this->mergeJsonConfig();
                }

                return $logManager;
            });

            Facade::setFacadeApplication($this->container);
        }
    }

    public static function make(): LoggerBuilder
    {
        if (!isset(static::$instance)) {
            static::$instance = new self();
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
                $currentConfig = $this->container->getBindings()['config'];
                $currentLoggingConfig = $currentConfig['logging'];
                $mergedLoggingConfig = array_merge($currentLoggingConfig, $loggerConfig);
                $mergedConfig = array_merge($currentConfig, $mergedLoggingConfig);
                $this->container->bind('config', function () use ($mergedConfig) {
                    return $mergedConfig;
                });
            }
        }

    }
}