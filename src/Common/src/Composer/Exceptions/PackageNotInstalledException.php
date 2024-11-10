<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Composer\Exceptions;

use EncoreDigitalGroup\StdLib\Exceptions\BaseException;
use EncoreDigitalGroup\StdLib\Objects\ExitCode;

class PackageNotInstalledException extends BaseException
{
    public function __construct(string $packageName)
    {
        parent::__construct("Composer package {$packageName} is not installed.", ExitCode::RESOURCE_UNAVAILABLE);
    }
}
