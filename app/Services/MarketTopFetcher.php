<?php

namespace Market\Console\Services;

use GuzzleHttp\Client;

class MarketTopFetcher
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return array|null
     * @throws \Exception
     */
    public function fetch(): ?array
    {
        $response = $this->getClient()->get($this->uri);

        $content = json_decode($response->getBody(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception(json_last_error_msg());
        }

        return $content['products'] ?? null;
    }

    /**
     * @return Client
     */
    private function getClient()
    {
        return new Client(['verify' => false]);
    }
}
