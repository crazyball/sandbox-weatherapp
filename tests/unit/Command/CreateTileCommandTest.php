<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Tests\unit\Command;

use PHPUnit\Framework\TestCase;
use WeatherApp\Command\CreateTileCommand;
use WeatherApp\Entity\Tile;

/**
 * CreateTileCommandTest
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class CreateTileCommandTest extends TestCase
{
    public function testCreateCommand()
    {
        $tile = $this->prophesize(Tile::class)->reveal();
        $command = new CreateTileCommand($tile);

        $this->assertInstanceOf(Tile::class, $command->getTile());
    }
}
