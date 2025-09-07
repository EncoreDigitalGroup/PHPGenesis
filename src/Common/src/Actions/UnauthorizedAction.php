<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Actions;

use EncoreDigitalGroup\StdLib\Exceptions\BaseException;
use EncoreDigitalGroup\StdLib\Objects\Filesystem\ExitCode;
use Throwable;

class UnauthorizedAction extends BaseException
{
    public function __construct(string $message = "This action is unauthorized.", int $code = ExitCode::INSUFFICIENT_PERMISSION, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}