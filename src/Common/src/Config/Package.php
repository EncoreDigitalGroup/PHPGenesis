<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Config;

enum Package: string
{
    case AWS = "phpgenesis/aws";
    case Common = "phpgenesis/common";
    case CLI = "phpgenesis/cli";
    case Logger = "phpgenesis/logger";
    case PHPGenesis = "phpgenesis/phpgenesis";
}
