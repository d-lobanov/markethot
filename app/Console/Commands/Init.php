<?php

namespace Market\Console\Commands;

use Illuminate\Console\Command;
use Market\ElasticScout\MarketIndexConfigurator;

class Init extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $signature = 'init:app';

    /**
     * {@inheritdoc}
     */
    protected $description = 'Init indexes etc';

    public function handle(): void
    {
        $this->call('key:generate');
        $this->call('elastic:create-index', [
            'index-configurator' => MarketIndexConfigurator::class,
        ]);
    }
}
