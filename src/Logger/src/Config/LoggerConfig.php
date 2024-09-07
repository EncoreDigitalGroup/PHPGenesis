<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger\Config;

use PHPGenesis\Common\Config\IModuleConfig;
use PHPGenesis\Common\Config\Traits\ConfigUtils;

class LoggerConfig implements IModuleConfig
{
    use ConfigUtils;

    public string $name = 'phpgenesis';
    public string $logFileName = 'phpgenesis.log';
    public string $logLevel = 'debug';
    public LoggerBetaFeatures $betaFeatures;

    public function __construct()
    {
        $this->betaFeatures = new LoggerBetaFeatures();
    }
}
