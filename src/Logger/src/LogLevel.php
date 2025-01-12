<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger;

use Monolog\Level;

class LogLevel
{
    const DEBUG = Level::Debug;
    const INFO = Level::Info;
    const NOTICE = Level::Notice;
    const WARNING = Level::Warning;
    const ERROR = Level::Error;
    const CRITICAL = Level::Critical;
    const ALERT = Level::Alert;
    const EMERGENCY = Level::Emergency;
}
