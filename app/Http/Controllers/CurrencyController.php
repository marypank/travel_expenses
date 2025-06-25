<?php

namespace App\Http\Controllers;

use App\Http\Services\CurrencyService;

class CurrencyController extends Controller
{
    // todo: посмотреть какая коллекция возвращается через ресурсы и нужно ли здесь переделать на нее
    public function __construct(private CurrencyService $currencyService)
    {}

    public function index()
    {
        return $this->currencyService->all();
    }

    public function show(int $id)
    {
        return $this->currencyService->getById($id);
    }
}
