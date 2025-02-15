<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Composer;

use Composer\Script\Event;
use PHPGenesis\Common\Attributes\Internal;
use PHPGenesis\Common\Support\IdeHelper;

#[Internal]
/** @internal */
class Scripts
{
    public static function postAutoloadDump(Event $event): void
    {
        require_once $event->getComposer()->getConfig()->get("vendor-dir") . "/autoload.php";
        $packageName = $event->getComposer()->getPackage()->getName();

        $isPhpGenesis = false;
        $usingPhpGenesis = false;

        $composer = file_get_contents("composer.json");

        if (is_string($composer)) {
            $composer = json_decode($composer);

            $requires = $composer->require;

            foreach ($requires as $package => $version) {
                if ($package == "phpgenesis/phpgenesis") {
                    $usingPhpGenesis = true;
                    break;
                }
            }

            if ($packageName == "phpgenesis/phpgenesis") {
                $isPhpGenesis = true;
                echo "Package is PHPGenesis Monorepo. Modifying IdeHelper::updateEditorConfig() behavior" . PHP_EOL;
            }

            IdeHelper::updateEditorConfig($isPhpGenesis, $usingPhpGenesis);
            IdeHelper::updatePint($isPhpGenesis, $usingPhpGenesis);
        }
    }
}
