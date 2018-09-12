<?php

namespace Market\Console\Services;

use Illuminate\Support\Facades\DB;
use Market\Console\Services\CategoryRawDataManager as CategoryManager;
use Market\Models\Product;

class ProductRawDataManager
{
    /**
     * @var CategoryManager
     */
    private $categoryManager;

    /**
     * @param CategoryManager $categoryManager
     */
    public function __construct(CategoryManager $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    /**
     * @param array $raw
     * @return Product
     */
    public function save(array $raw): Product
    {
        return DB::transaction(function () use ($raw) {
            $product = Product::updateOrCreate(['id' => $raw['id']], $raw);

            $categoryIds = array_column($raw['categories'], 'id');
            $product->categories()->sync($categoryIds);
            $product->offers()->delete();
            $product->offers()->createMany($raw['offers']);

            return $product;
        });
    }

    /**
     * @param array $products
     * @return array
     */
    public function replace(array $products)
    {
        $this->deleteIfNotInArray($products);

        return array_map([$this, 'save'], $products);
    }

    /**
     * @param array $products
     */
    private function deleteIfNotInArray(array $products)
    {
        $ids = array_column($products, 'id');

        Product::whereNotIn('id', $ids)->delete();
    }
}
