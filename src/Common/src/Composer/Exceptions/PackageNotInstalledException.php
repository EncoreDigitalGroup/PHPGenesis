<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Composer\Exceptions;

use BackedEnum;
use EncoreDigitalGroup\StdLib\Exceptions\BaseException;
use EncoreDigitalGroup\StdLib\Objects\Filesystem\ExitCode;

class PackageNotInstalledException extends BaseException
{
    public function __construct(string|BackedEnum $packageName)
    {
        if ($packageName instanceof BackedEnum) {
            $packageName = $packageName->value;
        }

        parent::__construct("Composer package {$packageName} is not installed.", ExitCode::RESOURCE_UNAVAILABLE);
    }
}
