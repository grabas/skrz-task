<?php
declare(strict_types=1);

namespace App\Repository\GoogleMapsGeocodeRepository;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class GoogleMapsGeocodeRepository
{
    private const ENDPOINT_URI = 'https://maps.googleapis.com/maps/api/geocode/json';

    /** @var Client */
    private $client;

    /** @var string */
    private $googleApiKey;

    /**
     * GoogleMapsGeocodeRepository constructor.
     * @param string $googleApiKey
     */
    public function __construct(string $googleApiKey)
    {
        $this->client = new Client();
        $this->googleApiKey = $googleApiKey;
    }

    /**
     * @param string $longitude
     * @param string $latitude
     * @return array
     */
    public function getAddress(string $longitude, string $latitude): array
    {
        $queryData = [
            'latlng' => $longitude . ',' . $latitude
        ];

        $response = $this->get($queryData);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param array $queryData
     * @return ResponseInterface
     */
    private function get(array $queryData): ResponseInterface
    {
        $queryData['key'] = $this->googleApiKey;

        $response = $this->client->get(self::ENDPOINT_URI, [
            'query' => $queryData
        ]);

        return $response;
    }
}
