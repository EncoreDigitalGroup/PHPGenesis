<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Support;

use EncoreDigitalGroup\StdLib\Objects\Filesystem\File;
use PHPGenesis\Common\Composer\Scripts;

class IdeHelper
{
    protected const string EDITOR_CONFIG_PATH = "Resources/.editorconfig";
    protected const string PINT_PATH = "Resources/pint.json";

    public static function updateEditorConfig(bool $isPhpGenesis, bool $usingPhpGenesis = false): void
    {
        $composer = Scripts::composer();
        if (
            !is_null($composer)
            && isset($composer->extra->phpgenesis->hasApplicationDirectory)
            && $composer->extra->phpgenesis->hasApplicationDirectory
        ) {
            IdeHelper::publishToProjectRoot(phpgenesis_common_src(self::EDITOR_CONFIG_PATH), "../.editorconfig", $isPhpGenesis, $usingPhpGenesis);
        }

        IdeHelper::publishToProjectRoot(phpgenesis_common_src(self::EDITOR_CONFIG_PATH), ".editorconfig", $isPhpGenesis, $usingPhpGenesis);
    }

    public static function updatePint(bool $isPhpGenesis, bool $usingPhpGenesis = false): void
    {
        $composer = Scripts::composer();
        if (
            !is_null($composer)
            && isset($composer->extra->phpgenesis->hasApplicationDirectory)
            && $composer->extra->phpgenesis->hasApplicationDirectory
        ) {
            IdeHelper::publishToProjectRoot(phpgenesis_common_src(self::PINT_PATH), "../pint.json", $isPhpGenesis, $usingPhpGenesis);
        }

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
