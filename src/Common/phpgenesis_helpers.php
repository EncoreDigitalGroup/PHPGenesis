<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

if (!function_exists("phpgenesis_vendor_dir")) {
    function phpgenesis_vendor_dir(?string $path = null, bool $usingPhpGenesis = false): string
    {
        if ($usingPhpGenesis) {
            if ($path == null) {
                return __DIR__ . "/../../";
            }

            return __DIR__ . "/../../" . $path;
        }

        return phpgenesis_module_vendor_dir($path);
    }
}

if (!function_exists("phpgenesis_module_vendor_dir")) {
    function phpgenesis_module_vendor_dir(?string $path = null): string
    {
        if ($path == null) {
            return __DIR__ . "/../";
        }

        return __DIR__ . "/../" . $path;
    }
}

if (!function_exists("phpgenesis_common_src")) {
    function phpgenesis_common_src(?string $path = null): string
    {
        if ($path == null) {
            return __DIR__ . "/src";
        }

        return __DIR__ . "/src/" . $path;
    }
}