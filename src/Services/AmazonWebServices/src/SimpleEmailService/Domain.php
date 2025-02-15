<?php

/*
 * Copyright (c) 2023-2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Services\AmazonWebServices\SimpleEmailService;

use Aws\Exception\AwsException;
use Aws\Result;
use Aws\Ses\SesClient;
use PHPGenesis\Services\AmazonWebServices\AwsClientConfiguration;

class Domain
{
    public string $domain;

    public static function getSesClient(): SesClient
    {
        return new SesClient(AwsClientConfiguration::get());
    }

    public function verifyDomainIdentity(): Result|string
    {
        $SesClient = self::getSesClient();
        try {
            return $SesClient->verifyDomainIdentity([
                "Domain" => $this->domain,
            ]);
        } catch (AwsException $e) {
            return $e->getMessage();
        }
    }

    public function verifyDomainDkim(): array|string
    {
        $SesClient = self::getSesClient();
        try {
            $Result = $SesClient->verifyDomainDkim([
                "Domain" => $this->domain,
            ]);

            return json_decode(json_encode($Result["DkimTokens"]));
        } catch (AwsException $e) {
            return $e->getMessage();
        }
    }
}
