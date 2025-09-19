<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    // todo: currently its database default laravel cache driver, to lazy to install redis

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return Cache::get($key);
    }

    /**
     * @param string $key
     * @param mixed $data
     * @param int $time
     * @return bool
     */
    public function set(string $key, $data, int $time)
    {
        return Cache::put($key, $data, $time);
    }
}