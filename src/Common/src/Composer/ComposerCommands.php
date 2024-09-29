<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Composer;

use PHPGenesis\Common\Attributes\Internal;

#[Internal]
class ComposerCommands
{
    const INSTALL = 'install';
    const UPDATE = 'update';
    const REMOVE = 'remove';
    const SHOW = 'show';
    const DUMP_AUTOLOAD = 'dump-autoload';
}
