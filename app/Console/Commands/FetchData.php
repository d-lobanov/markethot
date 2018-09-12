<?php

namespace Market\Console\Commands;

use Illuminate\Console\Command;
use Market\Console\Services\DataSynchronizer;

class FetchData extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $signature = 'fetch:data';

    /**
     * {@inheritdoc}
     */
    protected $description = 'Fetch data from markethot.ru';

    /**
     * @var DataSynchronizer
     */
    private $synchronizer;

    /**
     * {@inheritdoc}
     */
    public function __construct(DataSynchronizer $synchronizer)
    {
        $this->synchronizer = $synchronizer;

        parent::__construct();
    }

    /**
     * @return int
     */
    public function handle(): int
    {
        try {
            $products = $this->synchronizer->sync();
        } catch (\Exception $e) {
            $this->error('ERROR: ' . $e->getMessage());
            return 1;
        }

        $num = count($products);
        $this->line($num ? "$num products were migrated" : 'Nothing to process');

        return 0;
    }
}
