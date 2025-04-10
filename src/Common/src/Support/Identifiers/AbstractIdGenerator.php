<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Support\Identifiers;

/** @experimental */
abstract class AbstractIdGenerator
{
    public static function make(IdentifierSchema $schema): string
    {
        $static = new static($schema);

        return $static->generate();
    }

    abstract protected function generate(): string;
}