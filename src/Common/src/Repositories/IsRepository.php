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

    protected function map(): static
    {
        throw new NotImplementedException();
    }

    protected function mapModel(): static
    {
        throw new NotImplementedException();
    }

    protected function arrayMap(array $attributes): void
    {
        throw new NotImplementedException();
    }

    protected function fieldArray(): array
    {
        throw new NotImplementedException();
    }
}