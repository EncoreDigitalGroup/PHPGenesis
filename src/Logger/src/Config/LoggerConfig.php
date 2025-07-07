<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger\Config;

use PHPGenesis\Common\Attributes\Internal;
use PHPGenesis\Common\Config\IModuleConfig;
use PHPGenesis\Common\Config\PHPGenesisConfig;
use PHPGenesis\Common\Config\Traits\ConfigUtils;

#[Internal]
/** @internal */
class LoggerConfig implements IModuleConfig
{
    use ConfigUtils;

    public static self $config;
    public string $name = "phpgenesis";
    public string $logFileName = "phpgenesis.log";
    public string $logLevel = "debug";

    public function __construct()
    {
        $this->mergeConfigKeys();
    }

    public static function get(): LoggerConfig
    {
        if (!isset(static::$config)) {
            static::$config = new self;
        }

        return static::$config;
    }

    public function mergeConfigKeys(): void
    {
        $config = PHPGenesisConfig::get();

        if (isset($config->logger)) {
            $config = $config->logger;

            $this->mergeConfigKey($config, "name");
            $this->mergeConfigKey($config, "logFileName");
            $this->mergeConfigKey($config, "logLevel");

            static::$config = $this;
        }
    }

    private function mergeConfigKey(object $config, string $key): void
    {
        if (isset($config->{$key})) {
            $this->{$key} = $config->{$key};
        }
    }
}