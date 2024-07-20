<?php

namespace App\Http\Services\Api;

interface BaseApiInterface
{
    // todo: хотела сделать что-то типа read, но не знаю какую апишку буду использовать у городов
    public function get();
}