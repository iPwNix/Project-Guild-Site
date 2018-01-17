<?php

namespace BlizzardApi\Service;

use BlizzardApi\BlizzardClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * Class Abstract Service
 *
 * @author Oleg Kachinsky <logansoleg@gmail.com>
 */
class Service
{
    /**
     * @var BlizzardClient $blizzardClient Configured blizzard client
     */
    protected $blizzardClient;

    /**
     * @var string $serviceParam Service parameter
     */
    protected $serviceParam;

    /**
     * Service constructor
     *
     * @param BlizzardClient $blizzardClient Configured blizzard client
     */
    public function __construct(BlizzardClient $blizzardClient)
    {
        $this->blizzardClient = $blizzardClient;
    }

    /**
     * Request
     *
     * Make request with API url and specific URL suffix
     *
     * @param string $urlSuffix API URL method
     * @param array  $options   Options
     *
     * @return Response
     */
    protected function request($urlSuffix, array $options)
    {
        $client = new Client([
            'base_uri' => $this->blizzardClient->getApiUrl(),
        ]);

        $options = $this->generateQueryOptions($options);
        //var_dump($options);
        $result = $client->get($this->serviceParam.$urlSuffix, $options);
        //var_dump($result);
        return $result;
    }

    /**
     * Generate query options
     *
     * Setting default option to given options array if it does have 'query' key,
     * otherwise creating 'query' key with default options
     *
     * @param array $options
     *
     * @return array
     */
    private function generateQueryOptions(array $options = [])
    {
        if (isset($options['query'])) {
            $result = $options['query'] + $this->getDefaultOptions();
        } else {
            $result['query'] = $options + $this->getDefaultOptions();
        }

        return $result;
    }

    /**
     * Get default options
     *
     * Get default query options from configured Blizzard Client
     *
     * @return array
     */
    private function getDefaultOptions()
    {
        return [
            'locale' => $this->blizzardClient->getLocale(),
            'apiKey' => $this->blizzardClient->getApiKey(),
        ];
    }
}
