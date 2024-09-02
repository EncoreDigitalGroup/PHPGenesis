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
            // Step 1: Initialize the service container
            $this->container = new PhpGenesisContainer();

            // Step 2: Bind the HttpFactory to the container
            $this->container->singleton('http', function () {
                return new HttpFactory();
            });

            // Step 3: Set the container as the facade application
            Facade::setFacadeApplication($this->container);
        }
    }
}
