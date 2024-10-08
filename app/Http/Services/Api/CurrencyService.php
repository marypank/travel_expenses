<?php

namespace App\Http\Services\Api;

use App\Http\Services\CacheService;
use App\Models\Dto\Api\CurrencyDto;
use Illuminate\Database\Eloquent\Collection;
use GuzzleHttp\Client;

class CurrencyService
{
    // todo: мб (?) чуть позже сделать настройку переключения. Один сервис с данными от ЦБ РФ, другой - какой-то общий, где все курсы
    private const FILE_PATH = 'https://www.cbr-xml-daily.ru/daily_json.js';

    private const CACHE_KEY = 'currency';

    private const CACHE_TIME = 60 * 60 * 20;

    private Client $client;

    private Collection $currencyData;

    public function __construct(private CacheService $cacheService)
    {
        $this->client = new Client();
        $this->currencyData = new Collection();
    }

    public function all(): Collection
    {
        // todo: добавить id как ключи, чтобы искать было легче
        // todo: а если ошибка, что? как обработать
        $response = $this->cacheService->get(self::CACHE_KEY);
        if ($response) {
            return $response;
        }

        $response = $this->client->get(self::FILE_PATH);
        $content = $response->getBody()->getContents();

        $collection = new Collection();
        if (!$content) {
            $collection;
        }

        $result = json_decode($content, true);
        $valutes = $result['Valute'];

        foreach ($valutes as $valute) {
            $collection->add(new CurrencyDto(...$valute));
        }
        $this->addRussianValute($collection);

        $this->cacheService->set(self::CACHE_KEY, $collection, self::CACHE_TIME);

        return $collection;
    }

    public function getById(int $id): ?CurrencyDto
    {
        $this->currencyData = $this->currencyData->isEmpty() ? $this->all() : $this->currencyData;

        return $this->currencyData->first(fn ($item) => $item->getCode() === $id);
    }

    private function addRussianValute(Collection &$collection)
    {
        $rusRuble = [
            'ID' => 'R000',
            'NumCode' => '643',
            'CharCode' => 'RUB',
            'Nominal' => 1,
            'Name' => 'Росссийский рубль',
            'Value' => 1,
            'Previous' => 1,
        ];
        $collection->prepend(new CurrencyDto(...$rusRuble));
    }
}