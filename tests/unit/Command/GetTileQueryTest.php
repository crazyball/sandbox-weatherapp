<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Tests\unit\Command;

use WeatherApp\Command\GetTileQuery;
use PHPUnit\Framework\TestCase;
use WeatherApp\Entity\Tile;

/**
 * GetTileQueryTest
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class GetTileQueryTest extends TestCase
{
    public function testCreateCommand()
    {
        $command = new GetTileQuery(1);
        $this->assertEquals(1, $command->getId());
        $this->assertEquals(null, $command->getResponse());
    }

    public function testQueryResponse()
    {
        $tile = $this->prophesize(Tile::class)->reveal();
        $command = new GetTileQuery(1);
        $command->setResponse($tile);
        $this->assertEquals($tile, $command->getResponse());
    }
}
