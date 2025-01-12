<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Helpers;

use EncoreDigitalGroup\StdLib\Objects\File;

class IdeHelper
{
    private const string EDITOR_CONFIG_PATH = "Resources/.editorconfig";
    private const string PINT_PATH = "Resources/pint.json";

    public static function updateEditorConfig(bool $isPhpGenesis, bool $usingPhpGenesis = false): void
    {
        IdeHelper::publishToProjectRoot(phpgenesis_common_src(self::EDITOR_CONFIG_PATH), ".editorconfig", $isPhpGenesis, $usingPhpGenesis);
    }

    public static function updatePint(bool $isPhpGenesis, bool $usingPhpGenesis = false): void
    {
        IdeHelper::publishToProjectRoot(phpgenesis_common_src(self::PINT_PATH), "pint.json", $isPhpGenesis, $usingPhpGenesis);
    }

    public static function publishToProjectRoot(string $source, string $destination, bool $isPhpGenesis, bool $usingPhpGenesis = false): void
    {
        if ($isPhpGenesis) {
            File::copy($source, phpgenesis_common_src("../../../{$destination}"));
        } elseif ($usingPhpGenesis) {
            File::copy($source, phpgenesis_vendor_dir("../../../{$destination}", $usingPhpGenesis));
        } else {
            File::copy($source, phpgenesis_vendor_dir("../../{$destination}", $usingPhpGenesis));
        }
    }
}
