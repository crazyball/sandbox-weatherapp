<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Tests\unit\Command;

use WeatherApp\Command\GetWeatherDataForTileQuery;
use WeatherApp\Command\GetWeatherDataForTileQueryHandler;
use PHPUnit\Framework\TestCase;
use WeatherApp\Entity\Tile;
use WeatherApp\Utils\Response;
use WeatherApp\Utils\Weather;

/**
 * GetWeatherDataForTileQueryHandlerTest
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class GetWeatherDataForTileQueryHandlerTest extends TestCase
{
    /**
     * @var Weather
     */
    private $weatherClient;

    /**
     * @var GetWeatherDataForTileQueryHandler
     */
    private $handler;

    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->weatherClient = $this->prophesize(Weather::class);
        $this->handler = new GetWeatherDataForTileQueryHandler(
            $this->weatherClient->reveal()
        );
    }

    public function testCreateConstruct()
    {
        $this->assertInstanceOf(GetWeatherDataForTileQueryHandler::class, $this->handler);
    }

    public function testHandleCommand()
    {
        $tile = $this->prophesize(Tile::class)->reveal();
        $command = new GetWeatherDataForTileQuery($tile);
        $response = new Response();

        $this
            ->weatherClient
            ->getCurrent($command->getTile())
            ->shouldBeCalled()
            ->willReturn($response);

        $this->handler->handle($command);
        $this->assertEquals($response, $command->getResponse());
    }
}
