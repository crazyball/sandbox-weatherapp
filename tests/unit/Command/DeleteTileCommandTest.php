<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Tests\unit\Command;

use WeatherApp\Command\DeleteTileCommand;
use PHPUnit\Framework\TestCase;

/**
 * DeleteTileCommandTest
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class DeleteTileCommandTest extends TestCase
{
    public function testCreateCommand()
    {
        $command = new DeleteTileCommand(1);
        $this->assertEquals(1, $command->getId());
    }
}
