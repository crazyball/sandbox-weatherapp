<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Command;

/**
 * QueryInterface
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
interface QueryInterface
{
    /**
     * @return mixed
     */
    public function getResponse();

    /**
     * @param mixed $response
     */
    public function setResponse($response);
}
