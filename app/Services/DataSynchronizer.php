<?php

namespace Market\Console\Services;

use Market\Console\Services\CategoryRawDataManager as CategoryManager;
use Market\Console\Services\MarketTopFetcher as Fetcher;
use Market\Console\Services\ProductRawDataManager as ProductManager;
use Market\Models\SyncHistory;

/**
 * Synchronize data from MarketTop with application.
 */
class DataSynchronizer
{
    /**
     * @var MarketTopFetcher
     */
    private $fetcher;

    /**
     * @var ProductManager
     */
    private $productManager;

    /**
     * @var CategoryManager
     */
    private $categoryManager;

    /**
     * @var CachePool
     */
    private $cache;

    /**
     * @param MarketTopFetcher $fetcher
     * @param ProductRawDataManager $productManager
     * @param CategoryManager $categoryManager
     * @param CachePool $cache
     */
    public function __construct(
        Fetcher $fetcher,
        ProductManager $productManager,
        CategoryManager $categoryManager,
        CachePool $cache
    ) {
        $this->fetcher = $fetcher;
        $this->productManager = $productManager;
        $this->categoryManager = $categoryManager;
        $this->cache = $cache;
    }

    /**
     * @return array|null
     * @throws \Exception
     */
    public function sync(): ?array
    {
        try {
            $products = $this->doSync();
            SyncHistory::success(count($products));
        } catch (\Exception $e) {
            SyncHistory::fail($e->getMessage());
            throw $e;
        }

        return $products;
    }

    /**
     * @return array|null
     * @throws \Exception
     */
    private function doSync()
    {
        if (!$data = $this->fetcher->fetch()) {
            return null;
        }

        $this->validate($data);

        $this->categoryManager->multipleSave(array_column($data, 'categories'));
        $products = $this->productManager->replace($data);

        if ($products) {
            $this->cache->products()->flush();
        }

        return $products;
    }

    /**
     * @param array $data
     * @return array
     */
    private function validate(array $data)
    {
        return validator($data, [
            '*.id' => 'required|int',
            '*.title' => 'required|string|max:255',
            '*.image' => 'url|nullable',
            '*.description' => 'string|nullable',
            '*.first_invoice' => 'date|nullable',
            '*.url' => 'url|nullable',
            '*.price' => 'int|nullable',
            '*.amount' => 'int|nullable',

            '*.offers.id' => 'int',
            '*.offers.price' => 'int|nullable',
            '*.offers.amount' => 'int|nullable',
            '*.offers.sales' => 'int|nullable',
            '*.offers.article' => 'string|nullable',

            '*.categories.id' => 'int',
            '*.categories.title' => 'string',
            '*.categories.alias' => 'string',
            '*.categories.parent_id' => 'int|nullable',
        ])->validate();
    }
}
