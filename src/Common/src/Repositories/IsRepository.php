<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Repositories;

use EncoreDigitalGroup\StdLib\Exceptions\NotImplementedException;

trait IsRepository
{
    protected function arrayMapAttribute(string $property, string $attribute, array $attributes): void
    {
        if (isset($attributes[$attribute])) {
            $this->$property = $attributes[$attribute];
        }
    }
}