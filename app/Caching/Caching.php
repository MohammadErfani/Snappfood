<?php

namespace App\Caching;

use Carbon\Carbon;

abstract class Caching
{
    /**
     * This class is parent for all model we want to cache
     */

    /**
     * constant KEY: cache key, must override in all children class
     */
    const KEY = 'KEY';

    /**
     * @return string
     */
    public function getCacheKey():string
    {
        return static::KEY;
    }

    abstract public function all();

    /**
     * @param $cacheValue  // Model::all()
     * @return mixed  //check for cache or caching data and return
     */
    public function cache($cacheValue)
    {
        $key = $this->getCacheKey();
        return cache()->remember($key,Carbon::now()->addMonth(),function () use($cacheValue){
            return $cacheValue;
        });
    }

    /**
     * Delete Cache and call all function to reCache data
     * @return void
     */
    public function reCache()
    {
        $key = $this->getCacheKey();
        cache()->forget($key);
        $this->all();
    }
}
