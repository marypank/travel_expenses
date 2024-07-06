<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
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

    public function index(Request $request)
    {
        $result = $this->currencyService->all();

        return CurrencyResource::collection($result->all());
    }

    public function show(Request $request)
    {
        //
    }
}
