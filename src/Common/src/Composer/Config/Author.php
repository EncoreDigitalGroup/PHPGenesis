<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Composer\Config;

use PHPGenesis\Common\Attributes\Internal;

#[Internal]
/** @internal */
class Author
{
    public ?string $name = "Your Name";
    public ?string $email = "you@example.com";
    public ?string $homepage;
    public ?string $role = "Developer";
}
