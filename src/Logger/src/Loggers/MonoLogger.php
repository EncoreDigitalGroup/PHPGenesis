<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger\Loggers;

use PHPGenesis\Common\Attributes\Internal;
use PHPGenesis\Logger\BaseLogger;
use PHPGenesis\Logger\ILogger;
use PHPGenesis\Logger\LogLevel;

/**
 * @api
 *
 * @internal This class is not meant to be used by developers outside of the PHPGenesis\Logger namespace.
 */
#[Internal]
class MonoLogger extends BaseLogger implements ILogger
{
    public static function debug(string $message, ?array $context = []): void
    {
        $monoLogger = new MonoLogger;

        $monoLogger->log(LogLevel::DEBUG, $message, $context);

        unset($monoLogger);
    }

    public static function info(string $message, ?array $context = []): void
    {
        $monoLogger = new MonoLogger;

        $monoLogger->log(LogLevel::INFO, $message, $context);

        unset($monoLogger);
    }

    public static function notice(string $message, ?array $context = []): void
    {
        $monoLogger = new MonoLogger;

        $monoLogger->log(LogLevel::NOTICE, $message, $context);

        unset($monoLogger);
    }

    public static function warning(string $message, ?array $context = []): void
    {
        $monoLogger = new MonoLogger;

        $monoLogger->log(LogLevel::WARNING, $message, $context);

        unset($monoLogger);
    }

    public static function error(string $message, ?array $context = []): void
    {
        $monoLogger = new MonoLogger;

        $monoLogger->log(LogLevel::ERROR, $message, $context);

        unset($monoLogger);
    }

    public static function critical(string $message, ?array $context = []): void
    {
        $monoLogger = new MonoLogger;

        $monoLogger->log(LogLevel::CRITICAL, $message, $context);

        unset($monoLogger);
    }

    public static function alert(string $message, ?array $context = []): void
    {
        $monoLogger = new MonoLogger;

        $monoLogger->log(LogLevel::ALERT, $message, $context);

        unset($monoLogger);
    }

    public static function emergency(string $message, ?array $context = []): void
    {
        $monoLogger = new MonoLogger;

        $monoLogger->log(LogLevel::EMERGENCY, $message, $context);

        unset($monoLogger);
    }

    public static function shareContext(array $context): void
    {
        $monoLogger = new MonoLogger;

        /** @noinspection PhpExpressionResultUnusedInspection */
        $monoLogger->globalContext($context);

        unset($monoLogger);
    }

    public static function withContext(array $context): void
    {
        $monoLogger = new MonoLogger;

        /** @noinspection PhpExpressionResultUnusedInspection */
        $monoLogger->globalContext($context);

        unset($monoLogger);
    }
}
