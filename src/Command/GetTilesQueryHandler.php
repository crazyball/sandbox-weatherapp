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
class GetTilesQueryHandler
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
     * @param GetTilesQuery $command
     */
    public function handle(GetTilesQuery $command) : void
    {
        $command->setResponse($this->repository->findAll());
    }
}
