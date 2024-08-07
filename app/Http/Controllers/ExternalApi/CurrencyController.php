<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowCurrencyRequest;
use App\Http\Resources\CurrencyResource;
use App\Http\Services\Api\CurrencyService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    private CurrencyService $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function index()
    {
        $result = $this->currencyService->all();

        return CurrencyResource::collection($result->all());
    }

    public function show(int $id)
    {
        return new CurrencyResource($this->currencyService->getById($id));
    }
}
