<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Actions;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class UnauthorizedActionOverride
{
    /** @param  mixed  $value  The value to return when authorization fails */
    public function __construct(
        public readonly mixed $value = null
    ) {}
}
