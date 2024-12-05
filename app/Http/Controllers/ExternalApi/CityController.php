<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    // todo: сделать выбор, тянуть данные из апишки или, если существует, базы данных, т.е. нужен переключатель сервис, интерфейс типа driver
    public function index(Request $request)
    {
        //
    }

    public function show(int $id)
    {
        //
    }
}
