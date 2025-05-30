<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Support;

class DirectoryHelper
{
    public static function basePath(): string
    {
        $directoryPath = __DIR__;
        do {
            $isVendorPath = false;
            $currentDirectoryName = basename($directoryPath);
            $directoryPath = dirname($directoryPath);
            if ($currentDirectoryName == "vendor") {
                $isVendorPath = true;
            }
        } while ($isVendorPath == false);

        return $directoryPath;
    }
}