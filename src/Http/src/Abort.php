<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Http;

use Symfony\Component\HttpKernel\Exception\HttpException;

/** @experimental */
class Abort
{
    public static function code(int $code = 500, string $message = '', array $headers = []): void
    {
        static::handle($code, $message, $headers);
    }

    protected static function handle(int $code = 500, string $message = '', array $headers = []): void
    {
        throw new HttpException($code, $message, null, $headers);
    }
}