<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Composer;

use Composer\InstalledVersions;
use PHPGenesis\Common\Config\CommonConfig;
use PHPGenesis\Common\Config\Packages;

class Composer
{
    public static function installed(Packages|string $packageName, bool $global = false): bool
    {
        if ($packageName instanceof Packages) {
            $packageName = $packageName->value;
        }

        if ($global) {
            return self::globalInstallCheck($packageName);
        }

        return InstalledVersions::isInstalled($packageName);
    }

    public static function installPath(): ?string
    {
        return InstalledVersions::getInstallPath(CommonConfig::PACKAGE_NAME);
    }

    private static function globalInstallCheck(string $packageName): bool
    {
        if (InstalledVersions::isInstalled($packageName)) {
            return true;
        }

        return InstalledVersions::isInstalled(CommonConfig::GLOBAL_PACKAGE_NAME);
    }
}
