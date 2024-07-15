<?php

namespace Lieroes\OmnivaSDK\Infrastructure\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Monolog\Logger;

class OmnivaHttpClient
{
    private Client $client;

    public function __construct(
        private string $username,
        private string $password,
        private Logger $logger)
    {
        $this->client = new Client();
    }

    public function post(string $url, array $data): array
    {
        $this->logger->info('Sending POST request', ['url' => $url, 'data' => $data]);

        try {
            $response = $this->client->post($url, [
                'auth' => [$this->username, $this->password],
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $data
            ]);


            $responseData = json_decode($response->getBody()->getContents(), true);
            $this->logger->info('Received response', ['response' => $responseData]);

            return $responseData;
        } catch (GuzzleException $e) {
            $this->logger->error('Error communicating with Omniva API', ['error' => $e->getMessage()]);
            throw new \Exception("Error communicating with Omniva API: " . $e->getMessage());
        }
    }
}
