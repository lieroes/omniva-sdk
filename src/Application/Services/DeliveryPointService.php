<?php

namespace Lieroes\OmnivaSDK\Application\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Lieroes\OmnivaSDK\Application\Mappers\DeliveryPointMapper;
use Monolog\Logger;

class DeliveryPointService
{
    public function __construct(
        private Client $client,
        private Logger $logger
    )
    {
    }

    public function getDeliveryPoints(): array
    {
        $url = 'https://www.omniva.ee/locationsfull.json';

        try {
            $response = $this->client->get($url);
            $data = json_decode($response->getBody()->getContents(), true);

            $this->logger->info('Fetched delivery points successfully', ['count' => count($data)]);

            return array_map([DeliveryPointMapper::class, 'toDTO'], $data);
        } catch (GuzzleException $e) {
            $this->logger->error('Error fetching delivery points', ['error' => $e->getMessage()]);
            throw new \Exception("Error fetching delivery points: " . $e->getMessage());
        }
    }
}
