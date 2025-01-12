<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Config;

use PHPGenesis\Common\Composer\Composer;
use PHPGenesis\Common\Composer\Exceptions\PackageNotInstalledException;
use PHPGenesis\Common\Config\Traits\ConfigUtils;
use PHPGenesis\Logger\Config\LoggerConfig;
use PHPGenesis\Services\AmazonWebServices\Config\AwsConfig;

class CommonConfig implements IModuleConfig
{
    use ConfigUtils;

    const string FILE_NAME = PhpGenesisConfig::FILE_NAME;
    const string PACKAGE_NAME = Packages::Common->value;
    const string GLOBAL_PACKAGE_NAME = Packages::PHPGenesis->value;

    public static function aws(): AwsConfig
    {
        if (Composer::installed(Package::AWS, true)) {
            return AwsConfig::get();
        }

        throw new PackageNotInstalledException(Package::AWS);
    }

    public static function logger(): LoggerConfig
    {
        if (Composer::installed(Package::Logger, true)) {
            return LoggerConfig::get();
        }

        throw new PackageNotInstalledException(Package::Logger);
    }
}
