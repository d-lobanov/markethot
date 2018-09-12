<?php

namespace Market\Models;

/**
 * @property $id
 */
trait Searchable
{
    /**
     * @return string
     */
    public function getSearchIndex(): string
    {
        return $this->getTable();
    }

    /**
     * @return string
     */
    public function getSearchType(): string
    {
        return $this->getTable();
    }

    /**
     * @return array
     */
    public function toSearchArray(): array
    {
        return $this->toArray();
    }
}
