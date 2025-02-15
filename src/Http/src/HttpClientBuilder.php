<?php

namespace PHPGenesis\Http;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Facade;
use PHPGenesis\Common\Container\PhpGenesisContainer;

class HttpClientBuilder
{
    protected PhpGenesisContainer $container;

    public function __construct()
    {
        if (!PhpGenesisContainer::isLaravel()) {
            $this->container = PhpGenesisContainer::getInstance();

            $this->container->singleton("http", function (): HttpFactory {
                return new HttpFactory;
            });

            Facade::setFacadeApplication($this->container);
        }
    }
}
