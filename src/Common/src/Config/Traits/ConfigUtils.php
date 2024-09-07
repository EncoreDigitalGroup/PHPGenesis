<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Config\Traits;

use PHPGenesis\Common\Helpers\DirectoryHelper;

trait ConfigUtils
{
    protected static self $instance;

    public static function get(): self
    {
        if (!isset(static::$instance)) {
            static::$instance = new self();
        }

        return static::$instance;
    }
}
