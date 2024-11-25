<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Services\AmazonWebServices\Config;

use PHPGenesis\Common\Config\IModuleConfig;

class AwsConfig implements IModuleConfig
{
    const string CONFIG_CREDENTIALS_KEY = 'phpgenesis.amazonWebServices.credentials.key';
    const string CONFIG_CREDENTIALS_SECRET = 'phpgenesis.amazonWebServices.credentials.secret';

    public ?AwsCredentials $credentials = null;
    public string $region = 'us-east-1';
    public string $version = '2010-12-01';

    public function __construct()
    {
        $this->credentials = new AwsCredentials;
        $this->credentials->key = config(self::CONFIG_CREDENTIALS_KEY) ?? null;
        $this->credentials->secret = config(self::CONFIG_CREDENTIALS_SECRET) ?? null;
    }

    public static function get(): AwsConfig
    {
        return new AwsConfig;
    }
}
