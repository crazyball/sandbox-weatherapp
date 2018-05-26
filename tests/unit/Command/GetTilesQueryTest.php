<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Tests\unit\Command;

use WeatherApp\Command\GetTilesQuery;
use PHPUnit\Framework\TestCase;
use WeatherApp\Entity\Tile;

/**
 * GetTilesQueryTest
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class GetTilesQueryTest extends TestCase
{
    public function testCreateCommand()
    {
        $command = new GetTilesQuery();
        $this->assertEquals(null, $command->getResponse());
    }

    public function testQueryResponse()
    {
        $tile = $this->prophesize(Tile::class)->reveal();
        $command = new GetTilesQuery();
        $command->setResponse([$tile, $tile]);
        $this->assertCount(2, $command->getResponse());
    }
}
