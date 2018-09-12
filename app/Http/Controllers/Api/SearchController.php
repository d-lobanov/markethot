<?php

namespace Market\Http\Controllers\Api;

use Market\Console\Services\ProductEsRepository as Repository;
use Market\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * @param Repository $repo
     * @param string $query
     * @return mixed
     */
    public function find(Repository $repo, string $query)
    {
        return $repo->find($query);
    }
}
