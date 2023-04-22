<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ImdbService
{
    private $client;
    private $apiKey;
    private $apiHost;

    public function __construct(HttpClientInterface $client, string $apiKey, string $apiHost)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->apiHost = $apiHost;
    }

    public function getMoviePosterUrl(string $movieTitle): ?string
    {
        $response = $this->client->request('GET', 'https://' . $this->apiHost . '/auto-complete', [
            'query' => [
                'q' => $movieTitle,
            ],
            'headers' => [
                'x-rapidapi-key' => $this->apiKey,
                'x-rapidapi-host' => $this->apiHost,
            ],
        ]);

        $data = $response->toArray();

        if (isset($data['d'][0]['i']['imageUrl'])) {
            return $data['d'][0]['i']['imageUrl'];
        }

        return null;
    }
}
