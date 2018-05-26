<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Tests\unit\Command;

use Doctrine\ORM\EntityManagerInterface;
use WeatherApp\Command\CreateTileCommand;
use WeatherApp\Command\CreateTileCommandHandler;
use PHPUnit\Framework\TestCase;
use WeatherApp\Entity\Tile;

/**
 * CreateTileCommandHandlerTest
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class CreateTileCommandHandlerTest extends TestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CreateTileCommandHandler
     */
    private $handler;

    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->entityManager = $this->prophesize(EntityManagerInterface::class);
        $this->handler = new CreateTileCommandHandler($this->entityManager->reveal());
    }

    public function testCreateConstruct()
    {
        $this->assertInstanceOf(CreateTileCommandHandler::class, $this->handler);
    }

    public function testHandleCommand()
    {
        $tile = $this->prophesize(Tile::class)->reveal();
        $command = new CreateTileCommand($tile);

        $this
            ->entityManager
            ->persist($tile)
            ->shouldBeCalled();

        $this
            ->entityManager
            ->flush()
            ->shouldBeCalled();

        $this->handler->handle($command);
    }
}
