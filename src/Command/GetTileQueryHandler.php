<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Command;

use WeatherApp\Repository\TileRepository;

/**
 * GetTilesQueryHandler
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class GetTileQueryHandler
{
    /**
     * @var TileRepository
     */
    private $repository;

    /**
     * GetTilesQueryHandler constructor.
     *
     * @param TileRepository $repository
     */
    public function __construct(TileRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param GetTileQuery $command
     */
    public function handle(GetTileQuery $command) : void
    {
        $command->setResponse($this->repository->find($command->getId()));
    }
}
