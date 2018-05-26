<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Command;

use WeatherApp\Utils\Response;
use WeatherApp\Utils\Weather;

/**
 * GetWeatherDataForTileQueryHandler
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class GetWeatherDataForTileQueryHandler
{
    /**
     * @var Weather
     */
    private $weatherClient;

    /**
     * GetWeatherDataForTileQueryHandler constructor.
     *
     * @param Weather $weatherClient
     */
    public function __construct(Weather $weatherClient)
    {
        $this->weatherClient = $weatherClient;
    }

    /**
     * @param GetWeatherDataForTileQuery $command
     *
     * @return Response
     */
    public function handle(GetWeatherDataForTileQuery $command) : void
    {
        $command->setResponse($this->weatherClient->getCurrent($command->getTile()));
    }
}
