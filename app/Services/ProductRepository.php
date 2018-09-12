<?php

namespace Market\Console\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Market\Models\Offer;
use Market\Models\Product;

class ProductRepository
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
     * @param int $limit
     * @return Collection|Product[]
     */
    public function getBestSelling($limit = 20): Collection
    {
        $cache = $this->cache->products();

        return $cache->remember('best_selling', CachePool::DEFAULT_LIFETIME, function () use ($limit) {
            return $this->pullBestSelling($limit);
        });
    }

    /**
     * @param $limit
     * @return Collection
     */
    private function pullBestSelling($limit = 20)
    {
        $ids = Offer::query()
            ->select('product_id')
            ->groupBy('product_id')
            ->orderBy(DB::raw('SUM(sales)'), 'desc')
            ->limit($limit);

        return Product::query()
            ->joinSub($ids, 'sub', 'sub.product_id', 'id')
            ->with('offers', 'categories')
            ->get();
    }
}
