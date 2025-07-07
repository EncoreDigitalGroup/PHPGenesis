<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Http;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Facade;
use PHPGenesis\Common\Container\PHPGenesisContainer;

class HttpClientBuilder
{
    protected PHPGenesisContainer $container;

    public function __construct()
    {
        if (!PHPGenesisContainer::isLaravel()) {
            $this->container = PHPGenesisContainer::getInstance();

            $this->container->singleton("http", function (): HttpFactory {
                return new HttpFactory;
            });

            Facade::setFacadeApplication($this->container);
        }
    }
}
