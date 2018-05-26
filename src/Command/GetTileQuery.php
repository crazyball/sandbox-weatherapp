<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Command;

use WeatherApp\Entity\Tile;

/**
 * GetTilesQuery
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class GetTileQuery implements QueryInterface
{
    /**
     * @var
     */
    private $id;

    /**
     * @var Tile
     */
    private $response;

    /**
     * GetTileQuery constructor.
     *
     * @param int $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return Tile
     */
    public function getResponse() : ?Tile
    {
        return $this->response;
    }

    /**
     * @param Tile $response
     */
    public function setResponse($response) : void
    {
        $this->response = $response;
    }
}
