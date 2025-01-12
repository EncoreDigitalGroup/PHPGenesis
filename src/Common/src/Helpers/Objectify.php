<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Helpers;

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
