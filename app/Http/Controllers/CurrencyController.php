<?php

namespace App\Http\Controllers;

use App\Http\Services\CurrencyService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function __construct(private readonly CurrencyService $currencyService)
    {}

    public function index()
    {
        return response()->json([
            'data' => $this->currencyService->all(),
            'message' => '',
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $id)
    {
        return response()->json([
            'data' => $this->currencyService->getById($id),
            'message' => '',
        ]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
