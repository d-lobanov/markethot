<?php

namespace Market\Console\Services;

use Illuminate\Cache\TaggedCache;

class CachePool
{
    /**
     * Lifetime in minutes
     */
    const DEFAULT_LIFETIME = 10;

    /**
     * @var TaggedCache
     */
    private $products;

    public function __construct(TaggedCache $products)
    {
        $this->products = $products;
    }

    /**
     * @return TaggedCache
     */
    public function products()
    {
        return $this->products;
    }
}
