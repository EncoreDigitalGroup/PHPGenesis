<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Logger;

use Monolog\Level;

class LogLevel
{
    const Level DEBUG = Level::Debug;
    const Level INFO = Level::Info;
    const Level NOTICE = Level::Notice;
    const Level WARNING = Level::Warning;
    const Level ERROR = Level::Error;
    const Level CRITICAL = Level::Critical;
    const Level ALERT = Level::Alert;
    const Level EMERGENCY = Level::Emergency;
}
