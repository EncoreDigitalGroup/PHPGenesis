<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger\Loggers;

use Illuminate\Support\Facades\Log;
use PHPGenesis\Common\Attributes\Internal;

/** @internal */
#[Internal]
class LaravelLogger extends Log
{
    public static function betaLogContext(?array $context = []): array
    {
        if ($context == null) {
            return [];
        }

        return $context;
    }
}