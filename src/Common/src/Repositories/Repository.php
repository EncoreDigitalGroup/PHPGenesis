<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Repositories;

use EncoreDigitalGroup\StdLib\Exceptions\NotImplementedException;
use EncoreDigitalGroup\StdLib\Exceptions\NullExceptions\ArgumentNullException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class Repository implements IModelRepository
{
    use IsRepository;

    /** @var class-string */
    protected string $modelClass;

    protected ?Model $model;
    protected bool $usingToModel = false;

    /**
     * @param  class-string  $modelClass
     *
     * @throws ArgumentNullException
     * @throws NotImplementedException
     */
    public function __construct(?Model $model = null, ?string $modelClass = null)
    {
        if (!is_null($model)) {
            $this->model = $model;
            $this->map();
        }

        if (is_null($modelClass)) {
            throw new ArgumentNullException('modelClass');
        }

        $this->modelClass = $modelClass;
    }

    public static function make(?Model $model = null): static
    {
        if (is_null($model)) {
            /** @phpstan-ignore-next-line */
            return new static;
        }

        /** @phpstan-ignore-next-line */
        return new static($model, static::class);
    }

    public static function get(?Model $model = null): static
    {
        return static::make($model);
    }

    public function firstOrCreate(array $attributes = [], array $values = []): static
    {
        $this->model = $this->modelClass::firstOrCreate($attributes, $values);

        return $this->map();
    }

    public function all(): Collection
    {
        $allRecords = $this->modelClass::all();

        $records = [];

        foreach ($allRecords as $record) {
            // @phpstan-ignore-next-line
            $records[] = new static($record);
        }

        return collect($records);
    }

    public function find(int|string $id): static
    {
        $this->model = $this->modelClass::find($id);

        return $this->map();
    }

    public function save(): void
    {
        if (!$this->usingToModel) {
            $this->mapModel();
        }
        $this->model?->save();
    }

    public function updateOrCreate(array $attributes = [], array $values = []): static
    {
        $this->model = $this->modelClass::updateOrCreate($attributes, $values);

        return $this->map();
    }

    public function delete(): void
    {
        $this->model?->delete();
    }

    /** @deprecated use fromArray() instead. */
    public function fromAttributeArray(array $attributes): static
    {
        $this->arrayMap($attributes);

        return $this;
    }

    public function fromArray(array $attributes): static
    {
        $this->mapArray($attributes);

        return $this;
    }

    public function toModel(?array $attributes = null): static
    {
        $this->usingToModel = true;
        $modelAttributes = $attributes;
        if (is_null($attributes)) {
            $json = json_encode($this);
            if ($json) {
                $modelAttributes = json_decode($json, true);
            }
        }

        return $this->mapArray($modelAttributes, true);
    }

    /** @deprecated No replacement */
    protected function fieldArray(): array
    {
        return [];
    }

    abstract protected function map(): static;

    abstract protected function mapArray(array $attributes, bool $toModel = false): static;

    /** @deprecated use toModel() instead. */
    abstract protected function mapModel(): static;

    /** @deprecated use mapArray() instead. */
    abstract protected function arrayMap(array $attributes): void;
}