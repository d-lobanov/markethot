<?php

namespace Market\ElasticScout;

use ScoutElastic\SearchRule;

class ProductSearchRule extends SearchRule
{
    /**
     * @return array
     */
    public function buildQueryPayload(): array
    {
        $query = $this->builder->query;

        return [
            'should' => [
                [
                    'match' => [
                        'title' => [
                            'query' => $query,
                            'boost' => 2
                        ]
                    ]
                ],
                [
                    'match' => [
                        'description' => [
                            'query' => $query,
                            'boost' => 1
                        ]
                    ]
                ]
            ]
        ];
    }
}
