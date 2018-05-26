<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Command;

use WeatherApp\Entity\Tile;
use WeatherApp\Utils\Response;

/**
 * GetWeatherDataForTileQuery
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class GetWeatherDataForTileQuery implements QueryInterface
{
    /**
     * @var Tile
     */
    private $tile;

    /**
     * @var Response
     */
    private $response;

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

    /**
     * @return Response
     */
    public function getResponse() : ?Response
    {
        return $this->response;
    }

    /**
     * @param Response $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}
