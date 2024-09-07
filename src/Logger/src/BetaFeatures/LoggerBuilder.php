<?php

namespace PHPGenesis\Logger\BetaFeatures;

use Illuminate\Log\LogManager;
use Illuminate\Support\Facades\Facade;
use PHPGenesis\Common\Container\PhpGenesisContainer;

/** @internal */
class LoggerBuilder
{
    protected static LoggerBuilder $instance;
    protected PhpGenesisContainer $container;

    public function __construct()
    {
        if (!PhpGenesisContainer::isLaravel()) {
            $this->container = PhpGenesisContainer::getInstance();

            $this->container->singleton('log', function () {
                return new LogManager($this->container);
            });

            Facade::setFacadeApplication($this->container);
        }
    }

    public static function make(): LoggerBuilder
    {
        if (!isset(static::$instance)) {
            static::$instance = new self();
        }

        return static::$instance;
    }
}
