<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Repositories;

trait IsRepository
{
    protected function arrayMapAttribute(string $property, string $attribute, array $attributes, bool $toModel = false): void
    {
        if ($toModel) {
            if (isset($attributes[$attribute])) {
                $this->model->{$attribute} = $attributes[$attribute];
            }
        } else {
            if (isset($attributes[$attribute])) {
                $this->{$property} = $attributes[$attribute];
            }
        }

    }
}