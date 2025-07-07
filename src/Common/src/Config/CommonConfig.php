<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Config;

use PHPGenesis\CloudProviders\AmazonWebServices\Config\AwsConfig;
use PHPGenesis\Common\Composer\Composer;
use PHPGenesis\Common\Composer\Exceptions\PackageNotInstalledException;
use PHPGenesis\Common\Config\Traits\ConfigUtils;
use PHPGenesis\Logger\Config\LoggerConfig;

class CommonConfig implements IModuleConfig
{
    use ConfigUtils;

    const string FILE_NAME = PHPGenesisConfig::FILE_NAME;
    const string PACKAGE_NAME = Package::Common->value;
    const string GLOBAL_PACKAGE_NAME = Package::PHPGenesis->value;

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
