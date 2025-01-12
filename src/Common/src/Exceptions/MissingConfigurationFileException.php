<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Exceptions;

use EncoreDigitalGroup\StdLib\Exceptions\BaseException;
use EncoreDigitalGroup\StdLib\Objects\ExitCode;

class MissingConfigurationFileException extends BaseException
{
    public function __construct()
    {
        parent::__construct('PHPGenesis Configuration File is Missing', ExitCode::IO_ERROR);
    }
}
