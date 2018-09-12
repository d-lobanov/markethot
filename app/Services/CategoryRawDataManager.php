<?php

namespace Market\Console\Services;

use Illuminate\Support\Collection;
use Market\Models\Category;

class CategoryRawDataManager
{
    /**
     * @param array $data
     * @return Category
     */
    public function save(array $data): Category
    {
        return Category::updateOrCreate(['id' => $data['id']], $data);
    }

    /**
     * @param array $categories
     * @return Collection
     */
    public function multipleSave(array $categories): Collection
    {
        return collect($categories)
            ->flatten(1)
            ->unique('id')
            ->map([$this, 'save']);
    }
}
