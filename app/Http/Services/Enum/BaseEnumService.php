<?php

namespace App\Http\Services\Enum;

abstract class BaseEnumService implements BaseEnumServiceInterface
{
    protected abstract static function enumClass();
    
    public abstract function getDefault();

    public function all(bool $convertArray = false): array
    {
        $result = [];
        foreach (static::enumClass()::cases() as $item) {
            $result[] = $convertArray ? $this->toArray($item) : $item;
        }

        return $result;
    }

    public function getShortNames(): array
    {
        $result = [];
        foreach (static::enumClass()::cases() as $item) {
            $result[$item->value] = static::enumClass()::RUS_NAMES[$item->value];
        }

        return $result;
    }

    public function getByValue(int $id, bool $convertArray = false)
    {
        $item = static::enumClass()::tryFrom($id);
        if (!$item) {
            $item = $this->getDefault();
        }

        return $convertArray ? $this->toArray($item) : $item;
    }

    public function toArray($item): array
    {
        return [
            'id' => $item->value,
            'name' => $this->modifyEnumName($item->name),
        ];
    }

    protected function modifyEnumName(string $name): string
    {
        return ucfirst(strtolower($name));
    }
}