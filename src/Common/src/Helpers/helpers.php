<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

use EncoreDigitalGroup\StdLib\Exceptions\ImproperBooleanReturnedException;
use Illuminate\Support\Collection;
use PHPGenesis\Common\Support\Objectify;

if (!function_exists("objectify")) {
    /** @throws ImproperBooleanReturnedException */
    function objectify($value): stdClass|array
    {
        return Objectify::perform($value);
    }
}

if (!function_exists("dto")) {
    function dto($dto_class, $object): Collection
    {
        return collect(new $dto_class($object));
    }
}

if (!function_exists("dto_collection")) {
    function dto_collection($dto_class, $objects): Collection
    {
        $dto = [];
        foreach ($objects as $object) {
            $dto[] = new $dto_class($object);
        }

        return collect($dto);
    }
}
