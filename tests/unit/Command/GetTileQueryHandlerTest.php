<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Tests\unit\Command;

use WeatherApp\Command\GetTileQuery;
use WeatherApp\Command\GetTileQueryHandler;
use PHPUnit\Framework\TestCase;
use WeatherApp\Entity\Tile;
use WeatherApp\Repository\TileRepository;

/**
 * GetTileQueryHandlerTest
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class GetTileQueryHandlerTest extends TestCase
{
    /**
     * @var TileRepository
     */
    private $tileRepository;

    /**
     * @var GetTileQueryHandler
     */
    private $handler;

    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->tileRepository = $this->prophesize(TileRepository::class);
        $this->handler = new GetTileQueryHandler(
            $this->tileRepository->reveal()
        );
    }

    public function testCreateConstruct()
    {
        $this->assertInstanceOf(GetTileQueryHandler::class, $this->handler);
    }

    public function testHandleCommand()
    {
        $command = new GetTileQuery(42);
        $tile = $this->prophesize(Tile::class)->reveal();

        $this
            ->tileRepository
            ->find(42)
            ->shouldBeCalled()
            ->willReturn($tile);

        $this->handler->handle($command);
        $this->assertEquals($tile, $command->getResponse());
    }
}
