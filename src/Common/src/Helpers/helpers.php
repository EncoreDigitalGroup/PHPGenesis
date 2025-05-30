<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

use EncoreDigitalGroup\StdLib\Exceptions\ImproperBooleanReturnedException;
use Illuminate\Support\Collection;
use PHPGenesis\Common\Support\Objectify;

if (!function_exists("objectify")) {
    /**
     * @throws ImproperBooleanReturnedException
     * @deprecated No replacement.
     */
    function objectify($value): stdClass|array
    {
        return Objectify::perform($value);
    }
}

if (!function_exists("dto")) {
    /** @deprecated No replacement. */
    function dto($dto_class, $object): Collection
    {
        return collect(new $dto_class($object));
    }
}

if (!function_exists("dto_collection")) {
    /** @deprecated No replacement. */
    function dto_collection($dto_class, $objects): Collection
    {
        $dto = [];
        foreach ($objects as $object) {
            $dto[] = new $dto_class($object);
        }

        return collect($dto);
    }
}
