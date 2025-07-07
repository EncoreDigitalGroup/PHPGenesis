<?php

/*
 * Copyright (c) 2023-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\CloudProviders\AmazonWebServices\SimpleEmailService;

use Aws\Exception\AwsException;
use Aws\Result;
use Aws\Ses\SesClient;
use EncoreDigitalGroup\StdLib\Exceptions\ImproperBooleanReturnedException;
use PHPGenesis\CloudProviders\AmazonWebServices\AwsClientConfiguration;

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
        $sesClient = self::getSesClient();
        try {
            $result = $sesClient->verifyDomainDkim([
                "Domain" => $this->domain,
            ]);

            $encoded = json_encode($result["DkimTokens"]);

            if (!$encoded) {
                throw new ImproperBooleanReturnedException;
            }

            return json_decode($encoded);
        } catch (AwsException $e) {
            return $e->getMessage();
        }
    }
}
