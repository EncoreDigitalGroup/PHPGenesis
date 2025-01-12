<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Helpers;

class DirectoryHelper
{
    public static function basePath(): string
    {
        $directoryPath = __DIR__;
        do {
            $isVendorPath = false;
            $currentDirectoryName = basename($directoryPath);
            $directoryPath = dirname($directoryPath);
            if ($currentDirectoryName == 'vendor') {
                $isVendorPath = true;
            }
        } while ($isVendorPath == false);

        return $directoryPath;
    }
}