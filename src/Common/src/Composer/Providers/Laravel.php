<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Composer\Providers;

use PHPGenesis\Common\Attributes\Internal;
use PHPGenesis\Common\Composer\Composer;

#[Internal]
/** @internal */
class Laravel
{
    const PACKAGE_VENDOR = "laravel";

    public static function installed(string $packageName = "framework"): bool
    {

        if (Composer::installed(self::PACKAGE_VENDOR . "/" . $packageName)) {
            return true;
        }

        return Composer::installed(self::PACKAGE_VENDOR . "/framework");
    }
}
