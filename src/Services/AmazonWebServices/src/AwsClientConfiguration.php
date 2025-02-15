<?php

/*
 * Copyright (c) 2023-2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Services\AmazonWebServices;

use Exception;
use PHPGenesis\Services\AmazonWebServices\Config\AwsConfig;

class AwsClientConfiguration
{
    public static function get(): array
    {
        $config = AwsConfig::get();

        if (is_null($config->credentials) || is_null($config->credentials->key) || is_null($config->credentials->secret)) {
            throw new Exception("AWS credentials not set");
        }

        return [
            "credentials" => [
                "key" => $config->credentials->key,
                "secret" => $config->credentials->secret,
            ],
            "region" => $config->region,
            "version" => $config->region,
        ];
    }
}
