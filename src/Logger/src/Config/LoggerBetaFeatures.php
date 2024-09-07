<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger\Config;

use PHPGenesis\Common\Helpers\DirectoryHelper;

class LoggerBetaFeatures
{
    public bool $facade = false;

    public function __construct()
    {
        $basePath = DirectoryHelper::basePath();
        $configFilePath = $basePath . '/phpgenesis.json';

        if (file_exists($configFilePath)) {
            $configFile = file_get_contents($configFilePath);

            if ($configFile) {
                $configFile = json_decode($configFile);
                $this->facade = $configFile?->logger?->betaFeatures?->facade ?? false;
            }
        }
    }
}