<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Composer\Config;

use PHPGenesis\Common\Attributes\Internal;

#[Internal]
/** @internal */
class Autoload
{
    public ?array $psr4;
    public ?array $psr0;
    public ?array $classmap;
    public ?array $files;
}
