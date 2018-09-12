<?php

namespace Market\ElasticScout;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class MarketIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    /**
     * @var array
     */
    protected $settings = [
        'analysis' => [
            'filter' => [
                'ru_stop' => [
                    'type' => 'stop',
                    'stopwords' => '_russian_',
                ],
                'ru_stemmer' => [
                    'type' => 'stemmer',
                    'language' => 'russian',
                ],
            ],
            'analyzer' => [
                'default' => [
                    'char_filter' => [
                        'html_strip',
                    ],
                    'tokenizer' => 'standard',
                    'filter' => [
                        'lowercase',
                        'ru_stop',
                        'ru_stemmer',
                    ],
                ],
            ],
        ],
    ];
}

