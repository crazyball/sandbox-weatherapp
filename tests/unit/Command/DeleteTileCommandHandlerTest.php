<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Tests\unit\Command;

use Doctrine\ORM\EntityManagerInterface;
use WeatherApp\Command\DeleteTileCommand;
use WeatherApp\Command\DeleteTileCommandHandler;
use PHPUnit\Framework\TestCase;
use WeatherApp\Entity\Tile;
use WeatherApp\Repository\TileRepository;

/**
 * DeleteTileCommandHandlerTest
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class DeleteTileCommandHandlerTest extends TestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var TileRepository
     */
    private $tileRepository;

    /**
     * @var DeleteTileCommandHandler
     */
    private $handler;

    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->entityManager = $this->prophesize(EntityManagerInterface::class);
        $this->tileRepository = $this->prophesize(TileRepository::class);
        $this->handler = new DeleteTileCommandHandler(
            $this->entityManager->reveal(),
            $this->tileRepository->reveal()
        );
    }

    public function testCreateConstruct()
    {
        $this->assertInstanceOf(DeleteTileCommandHandler::class, $this->handler);
    }

    public function testHandleCommand()
    {
        $command = new DeleteTileCommand(42);
        $tile = $this->prophesize(Tile::class)->reveal();

        $this
            ->tileRepository
            ->find(42)
            ->shouldBeCalled()
            ->willReturn($tile);

        $this
            ->entityManager
            ->remove($tile)
            ->shouldBeCalled();

        $this
            ->entityManager
            ->flush()
            ->shouldBeCalled();

        $this->handler->handle($command);
    }
}
