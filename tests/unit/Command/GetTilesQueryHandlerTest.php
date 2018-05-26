<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Tests\unit\Command;

use WeatherApp\Command\GetTilesQuery;
use WeatherApp\Command\GetTilesQueryHandler;
use PHPUnit\Framework\TestCase;
use WeatherApp\Entity\Tile;
use WeatherApp\Repository\TileRepository;

/**
 * GetTilesQueryHandlerTest
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class GetTilesQueryHandlerTest extends TestCase
{
    /**
     * @var TileRepository
     */
    private $tileRepository;

    /**
     * @var GetTilesQueryHandler
     */
    private $handler;

    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->tileRepository = $this->prophesize(TileRepository::class);
        $this->handler = new GetTilesQueryHandler(
            $this->tileRepository->reveal()
        );
    }

    public function testCreateConstruct()
    {
        $this->assertInstanceOf(GetTilesQueryHandler::class, $this->handler);
    }

    public function testHandleCommand()
    {
        $command = new GetTilesQuery();
        $tile = $this->prophesize(Tile::class)->reveal();
        $result = [$tile];

        $this
            ->tileRepository
            ->findAll()
            ->shouldBeCalled()
            ->willReturn($result);

        $this->handler->handle($command);
        $this->assertCount(1, $command->getResponse());
        $this->assertEquals($result, $command->getResponse());
    }
}
