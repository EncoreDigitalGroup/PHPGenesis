<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Helpers;

use Composer\Composer;

class DirectoryHelper
{
    public static function basePath(): string
    {
        $composer = new Composer();
        return $composer->getConfig()->get('vendor-dir') . '/..';
    }
}