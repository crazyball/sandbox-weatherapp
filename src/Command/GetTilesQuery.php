<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Command;

/**
 * GetTilesQuery
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class GetTilesQuery implements QueryInterface
{
    /**
     * @var array
     */
    private $response;

    /**
     * @return array
     */
    public function getResponse() : ?array
    {
        return $this->response;
    }

    /**
     * @param array $response
     */
    public function setResponse($response) : void
    {
        $this->response = $response;
    }
}
