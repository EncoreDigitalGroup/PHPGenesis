<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Composer;

use Composer\InstalledVersions;
use PHPGenesis\Common\Config\CommonConfig;

class Composer
{
    public static function installed(string $packageName, bool $global = false): bool
    {
        if ($global) {
            return self::globalInstallCheck($packageName);
        }

        return InstalledVersions::isInstalled($packageName);
    }

    public static function installPath(): ?string
    {
        return InstalledVersions::getInstallPath(CommonConfig::PACKAGE_NAME);
    }

    private static function globalInstallCheck($packageName): bool
    {
        if (InstalledVersions::isInstalled($packageName)) {
            return true;
        }

        return InstalledVersions::isInstalled(CommonConfig::GLOBAL_PACKAGE_NAME);
    }
}
