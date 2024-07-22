<?php

namespace App\Http\Services;

use App\Models\Enum\SourceExpenseEnum;
use App\Repositories\TripRepository;

class SourceExpenseService
{
    public function all()
    {
        $result = [];
        foreach (SourceExpenseEnum::cases() as $item) {
            $result[] = $this->getItem($item);
        }

        return $result;
    }

    public function getById(int $id)
    {
        $item = SourceExpenseEnum::tryFrom($id);
        if (!$item) {
            return [];
        }

        return $this->getItem($item);
    }

    private function modifyEnumName(string $name): string
    {
        return ucfirst(strtolower($name));
    }

    private function getItem(SourceExpenseEnum $item): array
    {
        return [
            'id' => $item->value,
            'name' => $this->modifyEnumName($item->name),
            'rusName' => SourceExpenseEnum::RUS_NAMES[$item->value],
        ];
    }
}