<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Command;

use Doctrine\ORM\EntityManagerInterface;

/**
 * CreateTileCommandHandler
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class CreateTileCommandHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * GetTilesQueryHandler constructor.
     *
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param CreateTileCommand $command
     */
    public function handle(CreateTileCommand $command) : void
    {
        $this->manager->persist($command->getTile());
        $this->manager->flush();
    }
}