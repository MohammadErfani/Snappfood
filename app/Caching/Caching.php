<?php

namespace App\Caching;

use Carbon\Carbon;

abstract class Caching
{
    const KEY = 'KEY';

    public function getCacheKey()
    {
        return static::KEY;
    }

    abstract public function all();


    public function cache($cacheValue)
    {
        $key = $this->getCacheKey();
        return cache()->remember($key,Carbon::now()->addMonth(),function () use($cacheValue){
            return $cacheValue;
        });
    }

    public function reCache()
    {
        $key = $this->getCacheKey();
        cache()->forget($key);
        $this->all();
    }
}
