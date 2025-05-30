<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Support;

use EncoreDigitalGroup\StdLib\Exceptions\ImproperBooleanReturnedException;
use stdClass;

class Objectify
{
    /**
     * @throws ImproperBooleanReturnedException
     */
    public static function perform(iterable $value): stdClass|array
    {
        $json = json_encode($value);

        if ($json === false) {
            throw new ImproperBooleanReturnedException;
        }

        return json_decode($json);
    }
}
