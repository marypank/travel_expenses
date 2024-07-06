<?php

namespace App\Http\Services\Api;

use App\Models\Dto\Api\CurrencyDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class CurrencyService
{
    // todo: чуть позже сделать настройку переключения. Один сервис с данными от ЦБ РФ, другой - какой-то общий, где все курсы

    private const FILE_PATH = ''; // todo: здесь будет ссылка на файл

    public function __construct()
    {
        //
    }

    public function all(): Collection
    {
        // todo: REDIS cache
        $result = Storage::disk('local')->get('money.json');

        $collection = new Collection();
        if (!$result) {
            $collection;
        }

        $result = json_decode($result, true);
        $valutes = $result['Valute'];

        foreach ($valutes as $valute) {
            $collection->add(new CurrencyDto(...$valute));
        }

        return $collection;
    }

    public function getById(int $id): ?CurrencyDto
    {
        $currencies = $this->all();

        return $currencies->first(fn ($item) => $item->getCode() === $id);
    }
}