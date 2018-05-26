<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use WeatherApp\Entity\Tile;

/**
 * Weather Utility
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class Weather
{
    /**
     * @var Client
     */
    private $weatherClient;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Weather Utility constructor.
     *
     * @param Client              $weatherClient
     * @param SerializerInterface $serializer
     * @param string              $apiKey
     */
    public function __construct(Client $weatherClient, SerializerInterface $serializer, $apiKey)
    {
        $this->weatherClient = $weatherClient;
        $this->serializer = $serializer;
        $this->apiKey = $apiKey;
    }

    /**
     * Return current weather
     *
     * @param Tile $Tile
     *
     * @return Response
     *
     * @throws ClientException
     */
    public function getCurrent(Tile $Tile) : Response
    {
        $baseUri = '/data/2.5/weather?lang=fr&units=metric&APPID=' . $this->apiKey;
        $params = sprintf('&lat=%s&lon=%s', $Tile->getLatitude(), $Tile->getLongitude());
        $response = $this->weatherClient->get($baseUri . $params);

        return $this->serializer->deserialize($response->getBody()->getContents(), Response::class, 'json');
    }
}
