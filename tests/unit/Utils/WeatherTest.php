<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Tests\unit\Utils;

use GuzzleHttp\Client;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Serializer\SerializerInterface;
use WeatherApp\Entity\Tile;
use WeatherApp\Utils\Response;
use WeatherApp\Utils\Weather;
use PHPUnit\Framework\TestCase;

/**
 * WeatherTest
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class WeatherTest extends TestCase
{
    /**
     * @var Client|ObjectProphecy
     */
    private $client;

    /**
     * @var SerializerInterface|ObjectProphecy
     */
    private $serializer;

    /**
     * @var Weather
     */
    private $weather;

    public function setUp()
    {
        $this->client = $this->prophesize(Client::class);
        $this->serializer = $this->prophesize(SerializerInterface::class);
        $this->weather = new Weather(
            $this->client->reveal(),
            $this->serializer->reveal(),
            'dummyApiKey'
        );

        $this->assertInstanceOf(Weather::class, $this->weather);
    }

    public function testGetCurrentWeatherForTile()
    {
        $tile = $this->prophesize(Tile::class);
        $tile->getId()->willReturn(42);
        $tile->getLongitude()->willReturn(30000);
        $tile->getLatitude()->willReturn(40000);

        $guzzleResponse = new \GuzzleHttp\Psr7\Response();
        $response = new Response();

        $this
            ->client
            ->get(Argument::any())
            ->shouldBeCalled()
            ->willReturn($guzzleResponse);

        $this
            ->serializer
            ->deserialize(Argument::any(), Argument::any(), Argument::any())
            ->willReturn($response);

        $result = $this->weather->getCurrent($tile->reveal());


        $this->assertInstanceOf(Response::class, $result);
    }
}
