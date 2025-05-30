<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Repositories;

interface IModelRepository
{
    /** @phpstan-ignore-next-line */
    public function create(array $attributes = []);

    /** @phpstan-ignore-next-line */
    public function firstOrCreate(array $attributes = [], array $values = []);

    /** @phpstan-ignore-next-line */
    public function all();

    /** @phpstan-ignore-next-line */
    public function find(string|int $id);

    /** @phpstan-ignore-next-line */
    public function update(array $values);

    /** @phpstan-ignore-next-line */
    public function updateOrCreate(array $attributes = [], array $values = []);

    /** @phpstan-ignore-next-line */
    public function delete();
}
