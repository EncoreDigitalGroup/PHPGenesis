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
    const string INSTALL = "install";
    const string UPDATE = "update";
    const string REMOVE = "remove";
    const string SHOW = "show";
    const string DUMP_AUTOLOAD = "dump-autoload";
}
