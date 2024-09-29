<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger\Loggers;

use Illuminate\Support\Facades\Log;
use PHPGenesis\Common\Attributes\Internal;
use PHPGenesis\Logger\ILogger;

/**
 * @api
 *
 * @internal This class is not meant to be used by developers outside of the PHPGenesis\Logger namespace.
 */
#[Internal]
class LaravelLogger implements ILogger
{
    public static function debug($message, $context = []): void
    {
        Log::debug($message, $context);
    }

    public static function info($message, $context = []): void
    {
        Log::info($message, $context);
    }

    public static function notice($message, $context = []): void
    {
        Log::notice($message, $context);
    }

    public static function warning($message, $context = []): void
    {
        Log::warning($message, $context);
    }

    public static function error($message, $context = []): void
    {
        Log::error($message, $context);
    }

    public static function critical($message, $context = []): void
    {
        Log::critical($message, $context);
    }

    public static function alert($message, $context = []): void
    {
        Log::alert($message, $context);
    }

    public static function emergency($message, $context = []): void
    {
        Log::emergency($message, $context);
    }

    public static function shareContext(array $context): void
    {
        Log::shareContext($context);
    }

    public static function withContext(array $context): void
    {
        Log::withContext($context);
    }
}
