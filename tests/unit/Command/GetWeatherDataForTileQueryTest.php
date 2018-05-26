<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Tests\unit\Command;

use WeatherApp\Command\GetWeatherDataForTileQuery;
use PHPUnit\Framework\TestCase;
use WeatherApp\Entity\Tile;
use WeatherApp\Utils\Response;

/**
 * GetWeatherDataForTileQueryTest
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class GetWeatherDataForTileQueryTest extends TestCase
{
    public function testCreateCommand()
    {
        $tile = $this->prophesize(Tile::class)->reveal();
        $command = new GetWeatherDataForTileQuery($tile);
        $this->assertEquals($tile, $command->getTile());
        $this->assertEquals(null, $command->getResponse());
    }

    public function testQueryResponse()
    {
        $tile = $this->prophesize(Tile::class)->reveal();
        $response = new Response();
        $command = new GetWeatherDataForTileQuery($tile);
        $command->setResponse($response);
        $this->assertEquals($response, $command->getResponse());
    }
}
