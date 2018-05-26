<?php
/**
 * This file is part of weatherapp
 */

namespace WeatherApp\Command;

/**
 * DeleteTileCommand
 *
 * @author L. Ambrosini. <loic.ambrosini@me.com>
 */
class DeleteTileCommand
{
    /**
     * @var
     */
    private $id;

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
}
