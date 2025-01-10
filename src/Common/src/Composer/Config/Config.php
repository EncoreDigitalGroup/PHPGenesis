<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Composer\Config;

use PHPGenesis\Common\Attributes\Internal;
use stdClass;

#[Internal]
/** @internal */
class Config
{
    public ?bool $optimizeAutoloader = true;
    public ?string $preferredInstall = "dist";
    public ?bool $sortPackages = true;
    public ?object $allowPlugins;

    public function __construct()
    {
        $this->allowPlugins = new stdClass;
    }
}
