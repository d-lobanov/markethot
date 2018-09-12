<?php

namespace Market\Observers;

use Elasticsearch\Client;
use Market\Models\Searchable;

class ElasticsearchObserver
{
    /**
     * @var Client
     */
    private $elasticsearch;

    /**
     * ElasticsearchObserver constructor.
     * @param Client $elasticsearch
     */
    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }


    /**
     * @param Searchable $model
     */
    public function saved($model)
    {
        $this->elasticsearch->index([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->id,
            'body' => $model->toSearchArray(),
        ]);
    }

    /**
     * @param Searchable $model
     */
    public function deleted($model)
    {
        $this->elasticsearch->delete([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->id,
        ]);
    }
}