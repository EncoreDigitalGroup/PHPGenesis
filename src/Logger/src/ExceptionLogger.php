<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger;

use Exception;
use Illuminate\Support\Facades\Config;
use PHPGenesis\Common\Composer\Providers\Laravel;

/** @experimental */
class ExceptionLogger
{
    public static function debug(Exception $exception, string $message, array $context = []): void
    {
        $loggerMessage = self::buildMessage($message);
        $loggerContext = self::buildContext($exception, $context);

        Logger::debug($loggerMessage, $loggerContext);
    }

    public static function info(Exception $exception, string $message, array $context = []): void
    {
        $loggerMessage = self::buildMessage($message);
        $loggerContext = self::buildContext($exception, $context);

        Logger::info($loggerMessage, $loggerContext);
    }

    public static function notice(Exception $exception, string $message, array $context = []): void
    {
        $loggerMessage = self::buildMessage($message);
        $loggerContext = self::buildContext($exception, $context);

        Logger::notice($loggerMessage, $loggerContext);
    }

    public static function warning(Exception $exception, string $message, array $context = []): void
    {
        $loggerMessage = self::buildMessage($message);
        $loggerContext = self::buildContext($exception, $context);

        Logger::warning($loggerMessage, $loggerContext);
    }

    public static function error(Exception $exception, string $message, array $context = []): void
    {
        $loggerMessage = self::buildMessage($message);
        $loggerContext = self::buildContext($exception, $context);

        Logger::error($loggerMessage, $loggerContext);
    }

    public static function critical(Exception $exception, string $message, array $context = []): void
    {
        $loggerMessage = self::buildMessage($message);
        $loggerContext = self::buildContext($exception, $context);

        Logger::critical($loggerMessage, $loggerContext);
    }

    public static function alert(Exception $exception, string $message, array $context = []): void
    {
        $loggerMessage = self::buildMessage($message);
        $loggerContext = self::buildContext($exception, $context);

        Logger::alert($loggerMessage, $loggerContext);
    }

    public static function emergency(Exception $exception, string $message, array $context = []): void
    {
        $loggerMessage = self::buildMessage($message);
        $loggerContext = self::buildContext($exception, $context);

        Logger::emergency($loggerMessage, $loggerContext);
    }

    private static function buildMessage(string $message): string
    {
        return 'Exception: {exception.message}. ' . $message;
    }

    private static function buildContext(Exception $exception, array $context = []): array
    {
        $mergedContext = array_merge([
            'exception.message' => $exception->getMessage(),
            'exception.code' => $exception->getCode(),
            'exception.file' => $exception->getFile(),
            'exception.line' => $exception->getLine(),
        ], $context);

        if (Laravel::installed() && (Config::get('phpgenesis.logger.exception.includeStackTrace'))) {
            $mergedContext['exception.trace'] = $exception->getTrace();

            return $mergedContext;
        }

        if (!Laravel::installed()) {
            $mergedContext['exception.trace'] = $exception->getTrace();
        }

        return $mergedContext;
    }
}
