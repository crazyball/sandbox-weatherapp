<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Command;

use WeatherApp\Entity\Tile;

/**
 * CreateTileCommand
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class CreateTileCommand
{
    /**
     * @var Tile
     */
    private $tile;

    /**
     * GetTileQuery constructor.
     *
     * @param Tile $tile
     */
    public function __construct(Tile $tile)
    {
        $this->tile = $tile;
    }

    /**
     * @return Tile
     */
    public function getTile() : Tile
    {
        return $this->tile;
    }
}
