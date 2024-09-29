<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger\Config;

use PHPGenesis\Common\Attributes\Internal;

#[Internal]
class LoggerBetaFeatures
{
    public bool $facade = false;

    public function mergeConfigKeys(object $config): void
    {
        $this->mergeConfigKey($config, 'facade');
    }

    private function mergeConfigKey(object $config, string $key): void
    {
        if (isset($config->$key)) {
            $this->$key = $config->$key;
        }
    }
}