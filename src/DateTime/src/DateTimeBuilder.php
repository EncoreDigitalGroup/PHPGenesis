<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\DateTime;

use Illuminate\Support\DateFactory;
use Illuminate\Support\Facades\Facade;
use PHPGenesis\Common\Container\PHPGenesisContainer;

class DateTimeBuilder
{
    protected PHPGenesisContainer $container;

    public function __construct()
    {
        if (!PHPGenesisContainer::isLaravel()) {
            $this->container = PHPGenesisContainer::getInstance();

            $this->container->singleton("date", function (): DateFactory {
                return new DateFactory;
            });

            if (is_null(Facade::getFacadeRoot())) {
                Facade::setFacadeApplication($this->container);
            }
        }
    }
}