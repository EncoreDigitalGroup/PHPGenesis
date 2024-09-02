<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Helpers;

class IdeHelper
{
    private const string EDITOR_CONFIG_PATH = 'Resources/.editorconfig';

    public static function updateEditorConfig(bool $isPhpGenesis, bool $usingPhpGenesis = false): void
    {
        if ($isPhpGenesis) {
            file_copy(phpgenesis_common_src(self::EDITOR_CONFIG_PATH), phpgenesis_common_src('../../../.editorconfig'));
        } elseif ($usingPhpGenesis) {
            file_copy(phpgenesis_common_src(self::EDITOR_CONFIG_PATH), phpgenesis_vendor_dir('../../../.editorconfig', $usingPhpGenesis));
        } else {
            file_copy(phpgenesis_common_src(self::EDITOR_CONFIG_PATH), phpgenesis_vendor_dir('../../.editorconfig', $usingPhpGenesis));
        }

    }
}
