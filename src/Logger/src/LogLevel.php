<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Logger;

use Monolog\Level;

class LogLevel
{
    public const Level DEBUG = Level::Debug;
    public const Level INFO = Level::Info;
    public const Level NOTICE = Level::Notice;
    public const Level WARNING = Level::Warning;
    public const Level ERROR = Level::Error;
    public const Level CRITICAL = Level::Critical;
    public const Level ALERT = Level::Alert;
    public const Level EMERGENCY = Level::Emergency;
}
