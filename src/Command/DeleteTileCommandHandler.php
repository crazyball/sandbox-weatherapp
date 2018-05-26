<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Command;

use Doctrine\ORM\EntityManagerInterface;
use WeatherApp\Repository\TileRepository;

/**
 * DeleteTileCommandHandler
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class DeleteTileCommandHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var TileRepository
     */
    private $repository;

    /**
     * GetTilesQueryHandler constructor.
     *
     * @param EntityManagerInterface $manager
     * @param TileRepository     $repository
     */
    public function __construct(EntityManagerInterface $manager, TileRepository $repository)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }

    /**
     * @param DeleteTileCommand $command
     */
    public function handle(DeleteTileCommand $command) : void
    {
        $Tile = $this->repository->find($command->getId());
        $this->manager->remove($Tile);
        $this->manager->flush();
    }
}