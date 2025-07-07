<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger;

use PHPGenesis\Common\Composer\Providers\Laravel;
use PHPGenesis\Logger\Config\LoggerConfig;
use PHPGenesis\Logger\Loggers\LaravelLogger;
use PHPGenesis\Logger\Loggers\LaravelLoggerBuilder;
use PHPGenesis\Logger\Loggers\MonoLogger;

class Logger implements ILogger
{
    protected static LoggerConfig $config;

    public static function debug(string $message, array $context = []): void
    {
        if (Laravel::installed("support")) {
            LaravelLoggerBuilder::make();
            LaravelLogger::debug($message, $context);
        } else {
            MonoLogger::debug($message, $context);
        }
    }

    public static function info(string $message, array $context = []): void
    {
        if (Laravel::installed("support")) {
            LaravelLoggerBuilder::make();
            LaravelLogger::info($message, $context);
        } else {
            MonoLogger::info($message, $context);
        }
    }

    public static function notice(string $message, array $context = []): void
    {
        if (Laravel::installed("support")) {
            LaravelLoggerBuilder::make();
            LaravelLogger::notice($message, $context);
        } else {
            MonoLogger::notice($message, $context);
        }
    }

    public static function warning(string $message, array $context = []): void
    {
        if (Laravel::installed("support")) {
            LaravelLoggerBuilder::make();
            LaravelLogger::warning($message, $context);
        } else {
            MonoLogger::warning($message, $context);
        }
    }

    public static function error(string $message, array $context = []): void
    {
        if (Laravel::installed("support")) {
            LaravelLoggerBuilder::make();
            LaravelLogger::error($message, $context);
        } else {
            MonoLogger::error($message, $context);
        }
    }

    public static function critical(string $message, array $context = []): void
    {
        if (Laravel::installed("support")) {
            LaravelLoggerBuilder::make();
            LaravelLogger::critical($message, $context);
        } else {
            MonoLogger::critical($message, $context);
        }
    }

    public static function alert(string $message, array $context = []): void
    {
        if (Laravel::installed("support")) {
            LaravelLoggerBuilder::make();
            LaravelLogger::alert($message, $context);
        } else {
            MonoLogger::alert($message, $context);
        }
    }

    public static function emergency(string $message, array $context = []): void
    {
        if (Laravel::installed("support")) {
            LaravelLoggerBuilder::make();
            LaravelLogger::emergency($message, $context);
        } else {
            MonoLogger::emergency($message, $context);
        }
    }

    public static function shareContext(array $context): void
    {
        if (Laravel::installed("support")) {
            LaravelLoggerBuilder::make();
            LaravelLogger::shareContext($context);
        } else {
            MonoLogger::shareContext($context);
        }
    }

    public static function withContext(array $context): void
    {
        if (Laravel::installed("support")) {
            LaravelLoggerBuilder::make();
            LaravelLogger::withContext($context);
        } else {
            MonoLogger::withContext($context);
        }
    }
}
