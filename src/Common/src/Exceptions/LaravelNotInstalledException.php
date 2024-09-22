<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Exceptions;

use EncoreDigitalGroup\StdLib\Exceptions\BaseException;
use EncoreDigitalGroup\StdLib\Objects\ExitCode;

class LaravelNotInstalledException extends BaseException
{
    public function __construct()
    {
        parent::__construct('Laravel Is Not Installed.', ExitCode::RESOURCE_UNAVAILABLE);
    }
}
