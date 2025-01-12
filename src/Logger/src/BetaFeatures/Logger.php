<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger\BetaFeatures;

use Illuminate\Support\Facades\Log;
use PHPGenesis\Common\Attributes\Internal;

/** @internal */
#[Internal]
class Logger extends Log
{
    public static function betaLogContext(?array $context = []): array
    {
        if ($context == null) {
            return [];
        }

        return $context;
    }
}