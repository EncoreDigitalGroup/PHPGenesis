<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, int|string $externalId)
 *
 * @mixin Model
 */
trait HasExternalId
{
    public static function findByExternalId(string|int $externalId): ?self
    {
        return self::where("external_id", $externalId)->first();
    }
}
