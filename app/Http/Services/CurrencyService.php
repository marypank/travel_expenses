<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class CurrencyService
{
    // todo: заменить массив на dto
    private const FILE_PATH = 'https://www.cbr-xml-daily.ru/daily_json.js';

    private const CACHE_KEY = 'currency';

    private const CACHE_TIME = 60 * 60 * 20;

    private Client $client;

    private Collection $currencyData;

    public function __construct(private readonly CacheService $cacheService)
    {
        $this->client = new Client();
        $this->currencyData = new Collection();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function all(): Collection
    {
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
            $collection->add([
                'id' => $valute['NumCode'],
                'fullName' => $valute['Name'],
                'charName' => $valute['CharCode'],
                'nominal' => $valute['Nominal'],
                'value' => $valute['Value'],
            ]);
        }
        $this->addRussianValute($collection);

        $this->cacheService->set(self::CACHE_KEY, $collection, self::CACHE_TIME);

        return $collection;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        $this->currencyData = $this->currencyData->isEmpty() ? $this->all() : $this->currencyData;

        return $this->currencyData->first(fn ($item) => $item['id'] == $id) ?? [];
    }

    private function addRussianValute(Collection &$collection)
    {
        $rusRuble = [
            // 'ID' => 'R000',
            'id' => '643',
            'fullName' => 'Росссийский рубль',
            'charName' => 'RUB',
            'nominal' => 1,
            'value' => 1,
            // 'Previous' => 1,
        ];
        
        $collection->prepend($rusRuble);
    }
}