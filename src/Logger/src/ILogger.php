<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Logger;

interface ILogger
{
    public static function debug(string $message, array $context = []): void;

    public static function info(string $message, array $context = []): void;

    public static function notice(string $message, array $context = []): void;

    public static function warning(string $message, array $context = []): void;

    public static function error(string $message, array $context = []): void;

    public static function critical(string $message, array $context = []): void;

    public static function alert(string $message, array $context = []): void;

    public static function emergency(string $message, array $context = []): void;
}
