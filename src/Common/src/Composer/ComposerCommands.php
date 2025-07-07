<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Composer;

use PHPGenesis\Common\Attributes\Internal;

#[Internal]
/** @internal */
class ComposerCommands
{
    public const string INSTALL = "install";
    public const string UPDATE = "update";
    public const string REMOVE = "remove";
    public const string SHOW = "show";
    public const string DUMP_AUTOLOAD = "dump-autoload";
}
