<?php

namespace Market\Console\Services;

use Market\ElasticScout\ProductSearchRule;
use Market\Models\Product;

class ProductEsRepository
{
    /**
     * @var CachePool
     */
    private $cache;

    /**
     * @param CachePool $cache
     */
    public function __construct(CachePool $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param string $query
     * @return mixed
     */
    public function find(string $query)
    {
        $key = "product_search:$query";

        return $this->cache->products()->remember($key, CachePool::DEFAULT_LIFETIME, function () use ($query) {
            return Product::search($query)
                ->rule(ProductSearchRule::class)
                ->get()
                ->load('offers', 'categories');
        });
    }
}
