<?php

namespace App\Http\Services\Enum;

abstract class BaseEnumService implements DefaultEnumServiceInterface
{
    protected abstract static function enumClass();
    public abstract function getDefault();

    public function all(): array
    {
        $result = [];
        foreach (static::enumClass()::cases() as $item) {
            $result[] = $this->getItem($item);
        }

        return $result;
    }

    public function getById(int $id): array
    {
        $item = static::enumClass()::tryFrom($id);
        if (!$item) {
            return $this->getDefault();
        }

        return $this->getItem($item);
    }

    protected function getItem($item): array
    {
        return [
            'id' => $item->value,
            'name' => $this->modifyEnumName($item->name),
            'rusName' => static::enumClass()::RUS_NAMES[$item->value],
        ];
    }

    protected function modifyEnumName(string $name): string
    {
        return ucfirst(strtolower($name));
    }
}