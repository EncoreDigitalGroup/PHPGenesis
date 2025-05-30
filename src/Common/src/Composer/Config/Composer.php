<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Composer\Config;

use PHPGenesis\Common\Attributes\Internal;
use stdClass;

#[Internal]
class Composer
{
    public ?string $name;
    public ?string $type;
    public ?string $description;
    public ?array $keywords;
    public ?string $license;
    public ?array $repositories;
    public ?Config $config;
    public ?object $require;
    public ?object $requireDev;
    public ?Autoload $autoload;
    public ?array $authors = [];
    public ?object $replace;
    public ?string $minimumStability = "stable";
    public ?bool $preferStable = true;

    public function __construct()
    {
        $this->config = new Config;

        $this->require = new stdClass;
        $this->require->php = "^8.3";

        $this->authors[] = new Author;
    }
}
