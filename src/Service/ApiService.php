<?php

namespace App\Service;

use GuzzleHttp\Client;

class ApiService
{
    private $apiKey;
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchData(): array
    {
        $response = $this->client->request('GET', 'https://api.openweathermap.org/data/2.5/weather?q=wiesbaden,de&appid=!APIKEY!');

        $data = json_decode($response->getBody(), true);

        // Perform any filtering or processing on $data as needed

        return $data;
    }
}
